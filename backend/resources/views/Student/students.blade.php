<!-- Stored in resources/views/child.blade.php -->
@extends('Layout.layout')

@push('styles')

    <link rel="stylesheet" href="{{ asset('css/studentmanager.css') }}">

@endpush


@section('title', 'Admin login')

@section('sidebar')
    <div class="top-left links">
        <a href="/">HOME</a>
    </div>
    <div class="top-right links">
        <a>User:
            @if($admin)
                {{$admin}}
            @endif
        </a>

        <a href="{{route('logout')}}">LOGOUT</a>
    </div>
@endsection

@section('content')
    <div id="searchdiv">
        <form class="d-flex" action="{{route('student.search')}}" method="get" style="position:relative;">
            @csrf
            <input id="search" class="form-control me-2" name="search" placeholder="Search" aria-label="Search"
                   type="search" value="@isset($search){{$search}}@endisset">
            <button id="get-start" type="submit" class="btn btn-info">Search</button>
        </form>
    </div>
    <div id="add">
        <form action="{{route('student.create')}}" method="post">
            @csrf
            <input type="hidden" value="Add student" name="add">
            <button class="btn btn-outline-success" type="submit">Add Student</button>
        </form>
    </div>
    <div id="list_student">
        <table id="table" class="table">
            <thead>
            <tr>
                <th scope="col"><a href="{{route($path, ['col' => 'id', 'search' => $search??''])}}">ID</a></th>
                <th scope="col"><a href="{{route($path, ['col' => 'name', 'search' => $search??''])}}">Name</a></th>
                <th scope="col"><a href="{{route($path, ['col' => 'birthday', 'search' => $search??''])}}">Birthday</a></th>
                <th scope="col"><a href="{{route($path, ['col' => 'math', 'search' => $search??''])}}">Math</a></th>
                <th scope="col"><a href="{{route($path, ['col' => 'music', 'search' => $search??''])}}">Music</a></th>
                <th scope="col"><a href="{{route($path, ['col' => 'english', 'search' => $search??''])}}">English</a></th>
                <th scope="col"><a href="{{route($path, ['col' => 'gpa', 'search' => $search??''])}}">GPA</a></th>
                <th scope="col"><a href="{{route($path, ['col' => 'pass', 'search' => $search??''])}}">Pass</a></th>
            </tr>
            </thead>
            <tbody>
            @if(isset($students))
                @foreach($students as $student)
                    <tr>
                        <th scope="row">{{ $student->id }}</th>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->birthday }}</td>
                        <td>{{ $student->math }}</td>
                        <td>{{ $student->music }}</td>
                        <td>{{ $student->english }}</td>
                        <td>{{ $student->gpa }}</td>
                        <td>{{ $student->pass }}</td>
                    </tr>
                @endforeach
            @else
                <div id="mess" class="alert alert-danger">
                    No data!
                </div>
            @endif
            </tbody>
        </table>
    </div>
    @if(isset($students))
        {{ $students->withQueryString()->links() }}
    @endif
@endsection
