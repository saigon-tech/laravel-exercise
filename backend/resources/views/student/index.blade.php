<!-- Stored in resources/views/student/index.blade.php -->
@extends('layout.layout')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/student/index.css') }}">
@endpush
@section('title', __('student.index_title'))
@section('content')
    <div id="search-box">
        <form class="d-flex" action="{{route('student.index')}}" method="get">
            @csrf
            <input id="search" class="form-control me-2" name="search" placeholder="{{__('student.key_word')}}"
                   type="search" value="{{$search??''}}">
            <button type="submit" class="btn btn-info">{{__('student.search')}}</button>
        </form>
    </div>
    <div id="add">
        <a href="{{route('student.create')}}" class="btn btn-outline-success">
            {{__('student.add_btn')}}
        </a>
    </div>
    <div id="list-student">
        <table id="table" class="table">
            <thead>
            <tr>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'id', 'search' => $search??'', 'order' => $order??'down'])}}">
                        {{__('student.id')}}
                        @if($col=='id')&#{{$status}};@endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'name', 'search' => $search??'', 'order' => $order??'down'])}}">
                        {{__('student.name')}}
                        @if($col=='name')&#{{$status}};@endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'birthday', 'search' => $search??'', 'order' => $order??'down'])}}">
                        {{__('student.birthday')}}
                        @if($col=='birthday')&#{{$status}};@endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'math', 'search' => $search??'', 'order' => $order??'down'])}}">
                        {{__('student.math')}}
                        @if($col=='math')&#{{$status}};@endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'music', 'search' => $search??'', 'order' => $order??'down'])}}">
                        {{__('student.music')}}
                        @if($col=='music')&#{{$status}};@endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'english', 'search' => $search??'', 'order' => $order??'down'])}}">
                        {{__('student.english')}}
                        @if($col=='english')&#{{$status}};@endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'gpa', 'search' => $search??'', 'order' => $order??'down'])}}">
                        {{__('student.gpa')}}
                        @if($col=='gpa')&#{{$status}};@endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'pass', 'search' => $search??'', 'order' => $order??'down'])}}">
                        {{__('student.pass')}}
                        @if($col=='pass')&#{{$status}};@endif
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
                        <td>{{ date_format(date_create($student->birthday),'Y/m/d') }}</td>
                        <td>{{ $student->math }}</td>
                        <td>{{ $student->music }}</td>
                        <td>{{ $student->english }}</td>
                        <td>{{ $student->gpa }}</td>
                        <td>{{ $student->pass }}</td>
                        <td>
                            <form action="{{route('student.edit', $student->id)}}" method="get">
                                <input type="submit" class="btn btn-outline-success" value="{{__('student.edit_btn')}}"
                                       id="btnEdit">
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <div id="mess" class="alert alert-danger">
                    {{__('student.alert_data')}}
                </div>
            @endif
            @if(session('msg'))
                <div id="msg" class="alert alert-success">
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
    <script type="text/javascript" src="{{ asset('js/student/index.js') }}"></script>
@endpush
