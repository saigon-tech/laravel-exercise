@extends('layout')

@section('title', 'List of Students')

@section('content')
    <div class="d-flex justify-content-between">
        <h1>Student</h1>
        <a href="{{route('admin.logout')}}" class="btn d-flex align-items-center btn-outline-secondary">Logout</a>
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
        <a type="button" class="btn btn-outline-secondary" href="{{route('admin.addStudent')}}">Add Student</a>
    </div>
    @if ($students->isEmpty())
        <p>No results were found.</p>
    @else
        <table class="table">
            <thead class="table-bordered">
            <tr>
                <th scope="col">No</th>
                <th scope="col">
                    <a href="{{ sort_url('name', request()->get('order')) }}">
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
            @foreach($students as $student)
                @php
                    $grades = $student->grades->pluck('grade', 'subject');
                    $gpa = $grades->avg();
                @endphp
                <tr>
                    <th scope="row">{{$student->id}}</th>
                    <td>
                        <a href="{{ route('admin.editStudent', $student) }}">
                            {{ $student->name }}
                        </a>
                    </td>
                    <td>{{$student->birthday}}</td>
                    @foreach(config('constants.grades.subjects') as $subject)
                        <td>
                            {{ $grades->get($subject) }}
                        </td>
                    @endforeach
                    <td>{{round($gpa,2)}}</td>
                    <td>
                        {{ ($gpa > 5 ) ? 'Y' : 'N' }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    {{ $link->links() }}