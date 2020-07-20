<?php


namespace App\Http\Controllers;

use App\Grade;
use App\Student;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    public function getDanhSach()
    {
        $student = new Student();
        $students = $student->student();
        $direct = 'ASC';
        return view('home')->with('data', $students)->with('sorted', $direct);
    }

    public function sort($direct)
    {
        $student = new Student();
        $students = $student->sort($direct);
        if($direct == 'ASC')
        {
            $direct = 'DESC';
        } else
        {
            $direct = 'ASC';
        }
        return view('home')->with('sorted', $direct)->with('data', $students);
    }

    public function search(Request $request)
    {
        $student = new Student();
        $search = $request->input('search');
        $direct = 'ASC';
        if ($search != "") {
            $students = $student->search($request);
            return view('home')->with('data', $students)->with('sorted', $direct);
        }
    }

    public function quickSearch(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
//            $students = new Student();
            $student = DB::table('students')
                ->join('grades', 'students.id', '=', 'grades.student_id')
                ->select(DB::raw("students.id,students.name,students.birthday,
            sum(case when grades.subject = '1' then grades.grade else 0 end)
            as Math,sum(case when grades.subject = '2' then grades.grade else 0 end)
            as Music,sum(case when grades.subject = '3' then grades.grade else 0 end)
            as English"))
                ->where('name', 'LIKE', '%' . $request->search . '%')
                ->groupBy('students.id', 'students.name', 'students.birthday')
                ->get();
            if ($student) {
                foreach ($student as $key => $student) {
                    $tb = ($student->Math + $student->Music + $student->English) / 3;
                    if ($tb > 5) {
                        $p = 'Yes';
                    } else {
                        $p = 'No';
                    };
                    $output .= '<tr>
                    <td>' . $student->id . '</td>
                    <td>' . $student->name . '</td>
                    <td>' . $student->birthday . '</td>
                    <td>' . $student->Math . '</td>
                    <td>' . $student->Music . '</td>
                    <td>' . $student->English . '</td>
                    <td>' . $tb . '</td>
                    <td>' . $p . '</td>
                    </tr>';
                }
            }
            return Response($output);
        }
    }

    public function createStudent(Request $request)
    {
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
            return redirect('create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $student = new Student();
            $student->createStudent($request);
            return redirect('home');
        }
    }

    public function getEdit($id = false)
    {
        $student = new Student();
        $students = $student->getListEdit($id);
        return view('edit')->with('data', $students);
    }

    public function editStudent(Request $request)
    {
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
            return redirect('{id}')
                ->withErrors($validator)
                ->withInput();
        } else {
            $student = new Student();
            $student->editStudent($request);
            return redirect('home');
        }
    }
}
