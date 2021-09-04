<!-- Stored in resources/views/child.blade.php -->
@extends('Layout.layout')

@push('styles')

    <link rel="stylesheet" href="{{ asset('css/studentmanager.css') }}">

@endpush


@section('title', 'Admin login')

@section('sidebar')
    <div class="top-left links">
        <a href="{{route('student.index')}}">HOME</a>
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
        <button id="btnAdd" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#Modal">
            Add Student
        </button>
    </div>
    @if(session('msg'))
        <div class="alert alert-success">
            {{session('msg')}}
        </div>
    @endif
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
                    <tr data-bs-toggle="modal" data-bs-target="#Modal">
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


    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel" style="font-weight: bold"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('student.store')}}" method="post" id="modalForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" name="name" class="form-control" type="text">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Birthdate</label>
                            <input id="birthday" name="birthday" class="form-control" type="date">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="math">Math</label>
                            <select name="math" id="math" class="form-select" aria-label="math select">
                                @for($i=1;$i<=10;$i++)
                                    <option value="{{$i}}" selected? {{$i}}==1:>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="music">Music</label>
                            <select name="music" id="music" class="form-select" aria-label="music select">
                                @for($i=1;$i<=10;$i++)
                                    <option value="{{$i}}" selected? {{$i}}==1:>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="english">English</label>
                            <select name="english" id="english" class="form-select" aria-label="english select">
                                @for($i=1;$i<=10;$i++)
                                    <option value="{{$i}}" selected? {{$i}}==1:>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        @if($errors->any())
                            <ul class="alert text-danger" style="margin-left: 1.5rem;">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="modalForm">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#btnAdd").on("click", function(){
                document.querySelector("#modalLabel").textContent = "Add student";
                $('#modalForm')[0].reset();
            });
        });
        $(document).ready(function(){
            $("#table tbody tr").on("click", function(){
                document.querySelector("#modalLabel").textContent = "Edit student";
                let data = $(this).text().trim().split('\n').map(function(s) {
                    return String.prototype.trim.apply(s);
                });
                let col = document.querySelector("thead tr").textContent.trim().split('\n').map(function(s) {
                    return String.prototype.trim.apply(s).toLowerCase();
                });
                col.forEach(function(item, index, array) {
                    switch (item) {
                        case 'name':
                            $(".modal-body #name").val(data[index]);
                            break;
                        case "birthday":
                            $(".modal-body #birthday").val(data[index]);
                            break;
                        case "math":
                            $(".modal-body #math").val(data[index]);
                            break;
                        case "music":
                            $(".modal-body #music").val(data[index]);
                            break;
                        case "english":
                            $(".modal-body #english").val(data[index]);
                            break;
                        default:
                            break;
                    };
                });
            });
        });
    </script>
@endpush
