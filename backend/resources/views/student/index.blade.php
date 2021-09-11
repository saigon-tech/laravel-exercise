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
                @if(empty($order))
                    @php($order = 'down')
                @else
                    @if($order == 'up')
                        @php($order = 'down')
                    @else
                        @php($order = 'up')
                    @endif
                @endif
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'id', 'search' => $search??'', 'order' => $order??''])}}">
                        {{__('student.id')}}
                        @if(empty($status)!=true and $col =='id')
                            @if($status=='up')
                                &#8593;
                            @else
                                &#8595;
                            @endif
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'name', 'search' => $search??'', 'order' => $order??''])}}">
                        {{__('student.name')}}
                        @if(empty($status)!=true and $col =='name')
                            @if($status=='up')
                                &#8593;
                            @else
                                &#8595;
                            @endif
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'birthday', 'search' => $search??'', 'order' => $order??''])}}">
                        {{__('student.birthday')}}
                        @if(empty($status)!=true and $col =='birthday')
                            @if($status=='up')
                                &#8593;
                            @else
                                &#8595;
                            @endif
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'math', 'search' => $search??'', 'order' => $order??''])}}">
                        {{__('student.math')}}
                        @if(empty($status)!=true and $col =='math')
                            @if($status=='up')
                                &#8593;
                            @else
                                &#8595;
                            @endif
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'music', 'search' => $search??'', 'order' => $order??''])}}">
                        {{__('student.music')}}
                        @if(empty($status)!=true and $col =='music')
                            @if($status=='up')
                                &#8593;
                            @else
                                &#8595;
                            @endif
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'english', 'search' => $search??'', 'order' => $order??''])}}">
                        {{__('student.english')}}
                        @if(empty($status)!=true and $col =='english')
                            @if($status=='up')
                                &#8593;
                            @else
                                &#8595;
                            @endif
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'gpa', 'search' => $search??'', 'order' => $order??''])}}">
                        {{__('student.gpa')}}
                        @if(empty($status)!=true and $col =='gpa')
                            @if($status=='up')
                                &#8593;
                            @else
                                &#8595;
                            @endif
                        @endif
                    </a>
                </th>
                <th scope="col">
                    <a href="{{route('student.index', ['col' => 'pass', 'search' => $search??'', 'order' => $order??''])}}">
                        {{__('student.pass')}}
                        @if(empty($status)!=true and $col =='pass')
                            @if($status=='up')
                                &#8593;
                            @else
                                &#8595;
                            @endif
                        @endif
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
