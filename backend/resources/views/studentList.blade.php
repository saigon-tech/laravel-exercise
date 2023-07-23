@extends('layout')

@section('title', 'Login')
@push('styles')
    <link href="{{  asset('css/loginStyle.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="d-flex justify-content-between px-5 py-2">
        <h1>Student</h1>
        <a href="{{route('logout')}}" class="btn btn-danger d-flex align-items-center">Logout</a>
    </div>
    <div class="d-flex align-items-center">
        <p>Name</p>
        <form class="input-group mb-3 w-25" method="get" action="{{route('studentList')}}">
            <input type="text" class="form-control" placeholder="keyword" name="keyword"/>
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </form>
    </div>
    <div class="text-end px-5">
        <button type="button" class="btn btn-primary">Add Student</button>
    </div>
    @if ($students->isEmpty())
        <p>Không tìm thấy kết quả.</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col" class="cursor-pointer">
                    <a href="{{ route('studentList', ['sort_by' => 'name', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        Name
                    </a>
                </th>
                <th scope="col">Birthday</th>
                <th scope="col">Math</th>
                <th scope="col">Music</th>
                <th scope="col">English</th>
                <th scope="col">GPA</th>
                <th scope="col">Pass</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $key => $item)
                @php
                    $GPA = ($item['math'] + $item['music'] + $item['english'])/3;
                    $english = 0;
                    $math = 0;
                    $music = 0;
                    foreach ($item->grades as $grade) {
                        switch ($grade['subject']) {
                          case 'math':
                              $math = $grade['grade'];
                            break;
                          case 'music':
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
