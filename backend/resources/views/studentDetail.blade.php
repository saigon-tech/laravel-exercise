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

    <form class="input-group mb-3 w-25 d-flex flex-column mx-auto" method="post"
          action="{{isset($id) ? route('studentUpdate',['id' => $id]) : route('studentStore')}}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" type="text" class="form-control" value="{{$student['name'] ?? '' }}">
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Birthday</label>
            <input name="birthday" type="date" class="form-control" value="{{$student['birthday'] ?? '' }}">
            @error('birthday')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Math</label>
            <input name="math" type="number" class="form-control" value="{{$gradeMath['grade'] ?? '' }}">
            @error('math')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Music</label>
            <input name="music" type="number" class="form-control" value="{{$gradeMusic['grade'] ?? '' }}">
            @error('music')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">English</label>
            <input name="english" type="number" class="form-control" value="{{$gradeEnglish['grade'] ?? '' }}">
            @error('english')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="d-flex justify-content-center gap-2 px-5 py-2">
            @if(isset($id))
                <button disabled type="submit" class="btn btn-primary d-flex align-items-center">
                    Create
                </button>
                <button type="submit" class="btn btn-success d-flex align-items-center">
                    Save
                </button>
            @else
                <button type="submit" class="btn btn-primary d-flex align-items-center">
                    Create
                </button>
                <button disabled type="submit" class="btn btn-success d-flex align-items-center">
                    Save
                </button>
            @endif
        </div>
    </form>
    @if(session('success'))
        <p class="text-success display-3 text-center">{{session('success')}}</p>
        <div class="text-center">
            <a href="{{route('studentList')}}">Student List</a>
        </div>
    @endif
@endsection
