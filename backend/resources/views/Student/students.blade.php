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
        <form class="d-flex" action="{{route('studentManager.search')}}" method="post" style="position:relative;">
            @csrf
            <input id="search" class="form-control me-2" name="search" placeholder="Search" aria-label="Search" type="text">
            <button id="get-start" type="submit" class="btn btn-info">Search</button>
        </form>
        <ul class="alert text-danger" style="margin-left: 1.5rem; position: absolute;">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    <div id="add">
        <form>
            <button class="btn btn-outline-success" type="submit">Add Student</button>
        </form>
    </div>
    <div id="list_student">
        <table id="table" class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Birthday</th>
                <th scope="col">Math</th>
                <th scope="col">Music</th>
                <th scope="col">English</th>
                <th scope="col">GPA</th>
                <th scope="col">Pass</th>
            </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>
    </div>
    @if ($students instanceof \Illuminate\Pagination\AbstractPaginator)
        {{ $students->links() }}
    @endif
@endsection
