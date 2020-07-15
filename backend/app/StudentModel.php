<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentModel extends Model
{
    protected $table='students';

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
            ->where('students.name', 'like',$search)
            ->groupBy('students.id','students.name','students.birthday')
            ->paginate(10);
        return $student;
    }

    public  function  GetList()
    {
        $student = DB::table('students')
            ->join('grades', 'students.id', '=', 'grades.student_id')
            ->select(DB::raw("
            students.id,students.name,students.birthday,sum(case when grades.subject = '1' then grades.grade else 0 end)
            as Math,sum(case when grades.subject = '2' then grades.grade else 0 end)
            as Music,sum(case when grades.subject = '3' then grades.grade else 0 end)
            as English"))
            ->groupBy('students.id','students.name','students.birthday')
            ->paginate(5);

        return $student;
    }

    public  function AddStudent($request)
    {
        $name = $request->input('name');
        $birthday = $request->input('birthday');
        $math = $request->input('math');
        $music =$request->input('music');
        $english =$request->input('english');

        $id = DB::table('students')->insertGetID([
            'name' => $name,
            'birthday'=>$birthday,
        ]);
        if($id != null)
        {
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

    public function EditStudent($request)
    {
        $id = $request->input('idedit');
        $name = $request->input('name');
        $birthday = $request->input('birthday');
        $math = $request->input('math');
        $music = $request->input('music');
        $english = $request->input('english');
        DB::table('students')
            ->where('id',$id)
            ->update(['name'=>$name,'birthday'=>$birthday]);

        DB::table('grades')
            ->where(['student_id'=>$id,'subject'=>'1'])
            ->update(['grade'=>$math]);

        DB::table('grades')
            ->where(['student_id'=>$id,'subject'=>'2'])
            ->update(['grade'=>$music]);

        DB::table('grades')
            ->where(['student_id'=>$id,'subject'=>'3'])
            ->update(['grade'=>$english]);
    }

    public  function GetLisEdit($id)
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
