<?php

namespace App\Http\Controllers;
use App\StudentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Students_controller extends Controller
{
    public function index(Request $request)
    {
        $student = new StudentModel();
        if($request->isMethod('post'))
        {
            $search = $request->input('search');
            if($search != "")
            {
                $students = $student->Search($request);
                return view('Students_view')->with('data', $students);
            }
        }
        elseif($request->ajax())
        {
            $students = $student->GetList($request->sort);
            $output = '';
            $i = 1;
            foreach ($students as $item )
            {
                $tb = ($item->Math + $item->Music + $item->English) / 3;
                $pass = $tb > 5 ? 'Y' : 'N';
                $output .= '<tr>
                    <td>' . $i . '</td>
                    <td><a href="'.route('editstudent',['id'=>$item->id]).'">'.$item->name.'</a></td>
                    <td>' .\DateTime::createFromFormat('Y-m-d', $item->birthday)->format('Y/m/d'). '</td>
                    <td>' . $item->Math . '</td>
                    <td>' . $item->Music . '</td>
                    <td>' . $item->English . '</td>
                    <td>' .round($tb,1). '</td>
                    <td>' .$pass. '</td>
                    </tr>';
                $i+=1;
            }
            return response($output);
        }
        $students = $student->GetList();
        return view('Students_view')->with('data', $students);
    }

    public function  addstudent(Request $request)
    {
        $student = new StudentModel();
        if($request->isMethod('post'))
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
            if ($validator->fails())
            {
                return redirect('addstudent')
                    ->withErrors($validator)
                    ->withInput();
            } else
            {
                $student->AddStudent($request);
                return redirect('/student');
            }


        }
        return view('addstudent_view');
    }

    public function  editstudent(Request $request,$id = false)
    {
        $student = new StudentModel();
        if($request->isMethod('post'))
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
            if ($validator->fails())
            {
                //return redirect('editstudent/'.$id.'')
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } else
            {
                $student->EditStudent($request);
                return redirect('/student');
            }


        }

        $students = $student->GetLisEdit($id);
        return view('editstudent_view')->with('data', $students);
    }

}
