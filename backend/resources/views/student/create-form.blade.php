<!-- Stored in resources/views/child.blade.php -->


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/createform.css') }}">

@endpush
@extends('layout.layout')

@section('title', 'Admin login')

@section('sidebar')
    <div class="top-left links">
        <a href="{{route('student.index')}}">< BACK</a>
    </div>
    <div class="top-right links">
        <a>User:
            @if(isset($admin))
                {{$admin}}
            @endif
        </a>

        <a href="{{route('logout')}}">LOGOUT</a>
    </div>
@endsection

@section('content')
    <form action="{{route('student.store')}}" method="post" id="modalForm">
        @csrf
        <div class="mb-4">
            <h4 class="modal-title" id="modalLabel" style="font-weight: bold; text-align: center">
                ADD STUDENT
            </h4>
            <hr>
        </div>
        <div class="mb-3">
            @error('name')<span style="color: red;">• {{$message}}</span><br/>@enderror
            <label for="name" class="form-label">Name</label>
            <input id="name" name="name" class="form-control" type="text" value="{{old('name')}}">
        </div>
        <div class="mb-3">
            @error('birthday')<span style="color: red;">• {{$message}}</span><br/>@enderror
            <label for="exampleInputPassword1" class="form-label">Birthdate</label>
            <input id="birthday" name="birthday" class="form-control" type="date" value="{{old('birthday')}}">
        </div>
        <div class="mb-3">
            @error('math')<span style="color: red;">• {{$message}}</span><br/>@enderror
            <label class="form-label" for="math">Math</label>
            <select name="math" id="math" class="form-select" aria-label="math select" value="{{old('math')}}">
                @for($i=1;$i<=10;$i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            @error('music')<span style="color: red;">• {{$message}}</span><br/>@enderror
            <label class="form-label" for="music">Music</label>
            <select name="music" id="music" class="form-select" aria-label="music select" value="{{old('music')}}">
                @for($i=1;$i<=10;$i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            @error('english')<span style="color: red;">• {{$message}}</span><br/>@enderror
            <label class="form-label" for="english">English</label>
            <select name="english" id="english" class="form-select" aria-label="english select"
                    value="{{old('english')}}">
                @for($i=1;$i<=10;$i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mb-4" style="padding-top: 0.2rem; text-align: right;">
            <hr>
            <button type="submit" class="btn btn-primary" form="modalForm">Save</button>
        </div>
    </form>
@endsection