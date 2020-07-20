<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
class Student extends Model
{
    protected $table = 'students';

    use Sortable;

    protected $fillable = [
        'id', 'name', 'birthday',
    ];
    public $sortable = ['id', 'name', 'birthday'];

    public function student()
    {
        $students = DB::table('students')
            ->join('grades', 'students.id', '=', 'grades.student_id')
            ->select(DB::raw("students.id,students.name,students.birthday,
            sum(case when grades.subject = '1' then grades.grade else 0 end)
            as Math,sum(case when grades.subject = '2' then grades.grade else 0 end)
            as Music,sum(case when grades.subject = '3' then grades.grade else 0 end)
            as English"))
            ->groupBy('students.id', 'students.name', 'students.birthday')
            ->paginate(10);
        return $students;
    }

    public function sort($direct)
    {
        $students = DB::table('students')
            ->join('grades', 'students.id', '=', 'grades.student_id')
            ->select(DB::raw("students.id,students.name,students.birthday,
            sum(case when grades.subject = '1' then grades.grade else 0 end)
            as Math,sum(case when grades.subject = '2' then grades.grade else 0 end)
            as Music,sum(case when grades.subject = '3' then grades.grade else 0 end)
            as English"))
            ->groupBy('students.id', 'students.name', 'students.birthday')
            ->orderBy('name', $direct)
            ->paginate(10);
        return $students;
    }

    public function search($request)
    {
        $student = DB::table('students')
            ->join('grades', 'students.id', '=', 'grades.student_id')
            ->select(DB::raw("students.id,students.name,students.birthday,
            sum(case when grades.subject = '1' then grades.grade else 0 end)
            as Math,sum(case when grades.subject = '2' then grades.grade else 0 end)
            as Music,sum(case when grades.subject = '3' then grades.grade else 0 end)
            as English"))
            ->where('name', 'LIKE', '%' . $request->search . '%')
            ->groupBy('students.id', 'students.name', 'students.birthday')
            ->paginate(5);
        return $student;
    }

    public function createStudent($request)
    {
        $name = $request->input('name');
        $birthday = $request->input('birthday');
        $math = $request->input('math');
        $music = $request->input('music');
        $english = $request->input('english');

        $id = DB::table('students')->insertGetID([
            'name' => $name,
            'birthday' => $birthday,
        ]);
        if ($id != null) {
            DB::table('grades')->insert([
                'student_id' => $id,
                'subject' => '1',
                'grade' => $math,
            ]);
            DB::table('grades')->insert([
                'student_id' => $id,
                'subject' => '2',
                'grade' => $music,
            ]);
            DB::table('grades')->insert([
                'student_id' => $id,
                'subject' => '3',
                'grade' => $english,
            ]);
        }
    }

    public function getListEdit($id)
    {
        $student = DB::table('students')
            ->join('grades', 'students.id', '=', 'grades.student_id')
            ->select(DB::raw("
                    students.id,students.name,students.birthday,sum(case when grades.subject = '1' then grades.grade else 0 end)
                    as Math,sum(case when grades.subject = '2' then grades.grade else 0 end)
                    as Music,sum(case when grades.subject = '3' then grades.grade else 0 end)
                    as English"))
            ->where('students.id', '=', $id)
            ->groupBy('students.id', 'students.name', 'students.birthday')
            ->get();
        return $student;
    }

    public function editStudent($request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $birthday = $request->input('birthday');
        $math = $request->input('math');
        $music = $request->input('music');
        $english = $request->input('english');

        DB::table('students')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'birthday' => $birthday,
            ]);
        DB::table('grades')
            ->where('student_id', $id)
            ->where('subject', '1')
            ->update([
                'grade' => $math,
            ]);
        DB::table('grades')
            ->where('student_id', $id)
            ->where('subject', '2')
            ->update([
                'grade' => $music,
            ]);
        DB::table('grades')
            ->where('student_id', $id)
            ->where('subject', '3')
            ->update([
                'grade' => $english,
            ]);
    }

    public function grade()
    {
        return $this->hasMany('App\Grade', 'student_id', 'id');
    }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function fullTextWildcards($term)
    {
        // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach ($words as $key => $word) {
            /*
             * applying + operator (required word) only big words
             * because smaller ones are not indexed by mysql
             */
            if (strlen($word) >= 1) {
                $words[$key] = '+' . $word . '*';
            }
        }

        $searchTerm = implode(' ', $words);

        return $searchTerm;
    }

    public function scopeFullTextSearch($query, $columns, $term)
    {
        $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $this->fullTextWildcards($term));

        return $query;
    }
}
