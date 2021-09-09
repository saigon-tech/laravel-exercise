<!-- Stored in resources/views/student/student.blade.php -->
@extends('layout.layout')

@push('styles')

    <link rel="stylesheet" href="{{ asset('css/student/index.css') }}">

@endpush


@section('title', __('student-form.index-title'))

@section('sidebar')
    <div class="top-left links">
        <a href="{{route('student.index')}}">{{__('slide-bar.home')}}</a>
    </div>
    <div class="top-right links">
        <a style="float: left">{{__('slide-bar.user')}}
            @if($admin)
                {{$admin}}
            @endif
        </a>
        <form action="{{route('logout')}}" method="post" id="logout" style="float: right">
            @csrf
            <a href="javascript:$('#logout').submit();">{{__('slide-bar.logout')}}</a>
        </form>
    </div>
@endsection

@section('content')
    <div id="searchdiv">
        <form class="d-flex" action="{{route('student.index')}}" method="get" style="position:relative;">
            @csrf
            <input id="search" class="form-control me-2" name="search" placeholder="{{__('student-form.search')}}" aria-label="Search"
                   type="search" value="@isset($search){{$search}}@endisset">
            @if(isset($col))
                <input type="hidden" name="col" value="{{$col}}">
            @endif
            <button id="get-start" type="submit" class="btn btn-info">{{__('student-form.search')}}</button>
        </form>
    </div>
    <div id="add">
        <form action="{{route('student.create')}}" method="get">
            <input id="btnAdd" class="btn btn-outline-success" value="{{__('student-form.add-btn')}}" type="submit"/>
        </form>
    </div>
    <div id="list_student" style="position: relative">
        <table id="table" class="table">
            <thead>
            <tr>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'id', 'search' => $search??''])}}">
                        {{__('student-form.id')}}
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'name', 'search' => $search??''])}}">
                        {{__('student-form.name')}}
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'birthday', 'search' => $search??''])}}">
                        {{__('student-form.birthday')}}
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'math', 'search' => $search??''])}}">
                        {{__('student-form.math')}}
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'music', 'search' => $search??''])}}">
                        {{__('student-form.music')}}
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'english', 'search' => $search??''])}}">
                        {{__('student-form.english')}}
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'gpa', 'search' => $search??''])}}">
                        {{__('student-form.gpa')}}
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'pass', 'search' => $search??''])}}">
                        {{__('student-form.pass')}}
                    </a>
                </th>
                <th></th>
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
                        <td>
                            <form action="{{route('student.edit', $student->id)}}" method="get">
                                <input type="submit" class="btn btn-outline-success" value="{{__('student-form.edit-btn')}}" id="btnEdit">
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <div id="mess" class="alert alert-danger" style="text-align: center;">
                    {{__('student-form.alert-data')}}
                </div>
            @endif
            @if(session('msg'))
                <div id="msg" class="alert alert-success" style="text-align: center; position: absolute; width: 100%">
                    {{session('msg')}}
                </div>
            @endif
            </tbody>
        </table>
    </div>
    @if(isset($students))
        {{ $students->withQueryString()->links() }}
    @endif
@endsection
@push('js')
    <script>
        $(function () {
            $(document).click(function () {
                $('#msg').hide();
            });
        });
    </script>
@endpush
