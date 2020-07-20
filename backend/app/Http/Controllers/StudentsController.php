<?php


namespace App\Http\Controllers;
use App\StudentModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StudentsController extends Controller
{
    public function index(Request $request)
    {
        $y = new StudentModel();

        if($request->isMethod('post'))
        {
            $search = $request->input('search');
            if($search != "")
            {
                $x = $y->Search($request);
                return view('student')->with('data', $x);
            }
        }

        elseif ($request->ajax())
        {
            $x = $y->ListST($request->sort);
            $output = '';
            $i = 1;
            foreach ($x as $st)
            {
                $tb= ($st->Math + $st->Music + $st->English) / 3;
                $pass = $tb >5 ? 'Y' : 'N' ;
                $output .= '<tr>
                <td>'.$i.'</td>
                <td><a href="'.route('edit',['id'=>$st->id]).'">'.$st->name.'</a></td>
                <td>'.\DateTime::createFromFormat('Y-m-d', $st->birthday)->format('Y/m/d').'</td>
                <td>'.$st->Math.'</td>
                <td>'.$st->Math.'</td>
                <td>'.$st->Math.'</td>
                <td>'.round($tb,1).'</td>
                <td>'.$pass.'</td>
                </tr>';
                $i+=1;
            }
            return response($output);
        }

        $x = $y->listST();
        return view('student')->with('data', $x);
    }

    public  function add(Request $request)
    {
        $st = new StudentModel();
        if($request ->isMethod('post'))
        {
            $st->add($request);
            return  redirect('student');
        }
        return view('add');
    }

    public function edit(Request $request,$id = false)
    {
        $student = new StudentModel();
        if($request->isMethod('post'))
        {
            $student->edit($request);
            return  redirect('student');
        }
        $students = $student->listSTEdit($id);
        return view('edit')->with('data', $students);
    }

}
