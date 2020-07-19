<?php


namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentModel extends Model
{
    protected $table = 'students';

    public  function  Search($request)
    {
        $search = $request->input('search');

        $student = DB::table('students')
            ->join('grades', 'students.id', '=', 'grades.student_id')
            ->select(DB::raw("
                students.id,students.name,students.birthday,sum(case when grades.subject = '1' then grades.grade else 0 end)
                as Math,sum(case when grades.subject = '2' then grades.grade else 0 end)
                as Music,sum(case when grades.subject = '3' then grades.grade else 0 end)
                as English"))
            ->where('students.name', 'like','%'.$request->search.'%')
            ->groupBy('students.id','students.name','students.birthday')
            ->paginate(10);
        return $student;
    }

    public function searchByName(Request $request)
    {
        $students = student::where('name', 'like', '%' . $request->value . '%')->get();

        return response()->json($students);
    }

    public function listST()
    {
        $student = DB::table('students')
        ->join('grades', 'students.id', '=', 'grades.student_id')
        ->select(DB::raw("
            students.id,students.name,students.birthday,sum(case when grades.subject = '1' then grades.grade else 0 end)
            as Math,sum(case when grades.subject = '2' then grades.grade else 0 end)
            as Music,sum(case when grades.subject = '3' then grades.grade else 0 end)
            as English"))
        ->groupBy('students.id','students.name','students.birthday')
            ->paginate(10);

        return $student;
    }

    public  function  add($request)
    {
        $name = $request    ->input('name');
        $birthday = $request->input('birthday');
        $Math = $request->input('Math');
        $Music =$request->input('Music');
        $English =$request->input('English');
        $id = DB::table('students')->insertGetId(['name' => $name, 'birthday'=>$birthday]);
        if($id != null)
        {
            DB::table('grades')->insert(['student_id' => $id, 'subject' => '1', 'grade' => $Math ]);
            DB::table('grades')->insert(['student_id' => $id, 'subject' => '2', 'grade' => $Music ]);
            DB::table('grades')->insert(['student_id' => $id, 'subject' => '3', 'grade' => $English ]);
        }
    }
    public function edit($request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $birthday = $request->input('birthday');
        $Math = $request->input('Math');
        $Music = $request->input('Music');
        $English = $request->input('English');
        DB::table('students')->where('id',$id)->update(['name'=>$name,'birthday'=>$birthday]);
        DB::table('grades')->where(['student_id'=>$id,'subject'=>'1'])->update(['grade'=>$Math]);
        DB::table('grades')->where(['student_id'=>$id,'subject'=>'2'])->update(['grade'=>$Music]);
        DB::table('grades')->where(['student_id'=>$id,'subject'=>'3'])->update(['grade'=>$English]);
    }

    public  function listSTEdit($id)
    {
        $student = DB::table('students')
            ->join('grades', 'students.id', '=', 'grades.student_id')
            ->select(DB::raw("
            students.id,students.name,students.birthday,sum(case when grades.subject = '1' then grades.grade else 0 end)
            as Math,sum(case when grades.subject = '2' then grades.grade else 0 end)
            as Music,sum(case when grades.subject = '3' then grades.grade else 0 end)
            as English"))
            ->where('students.id', '=',$id)
            ->groupBy('students.id','students.name','students.birthday')
            ->get();
        return $student;
    }
}
