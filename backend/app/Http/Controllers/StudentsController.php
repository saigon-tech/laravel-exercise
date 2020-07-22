<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{

    public function index(Request $request)
    {

        $student = DB::table('students')
            ->join('grades', 'students.id', '=', 'grades.student_id')
            ->select(DB::raw("
            students.id,students.name,students.birthday,sum(case when grades.subject = '1' then grades.grade else 0 end)
            as Math,sum(case when grades.subject = '2' then grades.grade else 0 end)
            as Music,sum(case when grades.subject = '3' then grades.grade else 0 end)
            as English"))
            ->groupBy('students.id', 'students.name', 'students.birthday');
        if ($request->isMethod('GET')) {
            if ($request->input('sort') !== null)
                $sort = $request->input('sort');
            else
                $sort = 'ASC';
            $search = $request->input('search');
            if ($search != "") {
                $student->where('students.name', 'like', '%' . $search . '%');

                $students = $student->paginate(2);
                return view('students_view')->with(['data' => $students, 'search' => $search]);
            } elseif ($sort !== null) {
                $student->orderBy('students.name', '' . $sort . '');
                $students = $student->paginate(5);
                return view('students_view')->with(['data' => $students, 'sort' => $sort]);
            }

        }
        $students = $student->paginate(5);
        return view('students_view')->with('data', $students);
    }

    public function addstudent(Request $request)
    {

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(),
                [
                    'name' => 'bail|required',
                    'birthday' => 'bail|required',
                    'math' => 'bail|required|integer',
                    'music' => 'bail|required|integer',
                    'english' => 'bail|required|integer',
                ],
                [
                    'math.integer' => 'Dữ liệu phải là số nguyên',
                    'music.integer' => 'Dữ liệu phải là số nguyên',
                    'english.integer' => 'Dữ liệu phải là số nguyên',
                ]);
            if ($validator->fails()) {
                return redirect('addstudent')
                    ->withErrors($validator)
                    ->withInput();
            } else {

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
                return redirect('/student');
            }
        }
        return view('addstudent_view');
    }

    public function editstudent(Request $request, $id = false)
    {

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(),
                [
                    'name' => 'bail|required',
                    'birthday' => 'bail|required',
                    'math' => 'bail|required|integer',
                    'music' => 'bail|required|integer',
                    'english' => 'bail|required|integer',
                ],
                [
                    'math.integer' => 'Dữ liệu phải là số nguyên',
                    'music.integer' => 'Dữ liệu phải là số nguyên',
                    'english.integer' => 'Dữ liệu phải là số nguyên',
                ]);
            if ($validator->fails()) {
                //return redirect('editstudent/'.$id.'')
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } else {

                $idd = $request->input('idedit');
                $name = $request->input('name');
                $birthday = $request->input('birthday');
                $math = $request->input('math');
                $music = $request->input('music');
                $english = $request->input('english');
                DB::table('students')
                    ->where('id', $idd)
                    ->update(['name' => $name, 'birthday' => $birthday]);

                DB::table('grades')
                    ->where(['student_id' => $idd, 'subject' => '1'])
                    ->update(['grade' => $math]);

                DB::table('grades')
                    ->where(['student_id' => $idd, 'subject' => '2'])
                    ->update(['grade' => $music]);

                DB::table('grades')
                    ->where(['student_id' => $idd, 'subject' => '3'])
                    ->update(['grade' => $english]);
                return redirect('/student');
            }
        }

        $student = DB::table('students')
            ->join('grades', 'students.id', '=', 'grades.student_id')
            ->select(DB::raw("
                    students.id,students.name,students.birthday,sum(case when grades.subject = '1' then grades.grade else 0 end)
                    as Math,sum(case when grades.subject = '2' then grades.grade else 0 end)
                    as Music,sum(case when grades.subject = '3' then grades.grade else 0 end)
                    as English"))
            ->where('students.id', '=', $id)
            ->groupBy('students.id', 'students.name', 'students.birthday');
        $students = $student->get();

        return view('editstudent_view')->with('data', $students);
    }
}
