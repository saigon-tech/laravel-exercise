@extends('layout')

@section('title', 'List of Students')

@section('content')
    <div class="d-flex justify-content-between">
        <h1>Student</h1>
    <a href="{{route('logout')}}" class="btn d-flex align-items-center btn-outline-secondary">Logout</a>
    </div>
    <div class="d-flex align-item-center">
        <form class="input-group input-group-sm mb2">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
            </div>
            <input type="text" placeholder="keyword" name="keyword"/>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary">Search</button>
            </div>
        </form>
    </div>
    <div class="text-end">
        <a type="button" class="btn btn-outline-secondary" href="{{route('addStudent')}}">Add Student</a>
    </div>
    @if ($students->isEmpty())
        <p>No results were found.</p>
    @else
    <table class="table">
        <thead class="table-bordered">
            <tr>
                <th scope="col">No</th>
                <th scope="col">
                    <a href="{{ route('studentList', ['sort_by' => 'name', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        Name
                    </a></th>
                <th scope="col">Birthday</th>
                <th scope="col">Math</th>
                <th scope="col">Music</th>
                <th scope="col">English</th>
                <th scope="col">GPA</th>
                <th scope="col">Pass</th>
            </tr>
        </thead>
        <tbody>
        @foreach($students as $key =>$item)
        @php
            $english = 0;
            $math = 0;
            $music = 0;
            foreach ($item->grade as $grade) {
                switch ($grade['subject']) {
                  case 'Math':
                      $math = $grade['grade'];
                    break;
                  case 'Music':
                      $music = $grade['grade'];
                    break;
                  default:
                      $english = $grade['grade'];
                }
            }
            $GPA = ($english + $math + $music)/3;
        @endphp
            <tr>
                <th scope="row">{{$item['id']}}</th>
                <td>{{$item['name']}}</td>
                <td>{{$item['birthday']}}</td>
                <td>{{$math}}</td>
                <td>{{$music}}</td>
                <td>{{$english}}</td>
                <td>{{$GPA}}</td>
                <td>
                    @if($GPA > 5)
                        Y
                    @else
                        N
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
    {{ $students->appends(['keyword' => $keyword, 'sort_by' => $sortBy, 'sort_order' => $sortOrder])->links() }}
@endsection
