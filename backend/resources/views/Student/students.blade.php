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
    <div id="search">
        <form class="d-flex">
            <input id="myInput" class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                   onkeyup="myFunction()">
        </form>
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
    {{ $students->links() }}
@endsection
@push('js')
    <script>
        function myFunction() {
            let input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("table");
            tr = table.getElementsByTagName("tr");
            @foreach($students as $student)
                td = Object.values(@json($student))[1];
                if (td) {
                    txtValue = td;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[Object.values(@json($student))[0]].style.display = "";
                    } else {
                        tr[Object.values(@json($student))[0]].style.display = "none";
                    }
                }
            @endforeach
        }
    </script>
@endpush
