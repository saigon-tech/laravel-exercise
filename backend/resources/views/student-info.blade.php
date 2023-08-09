@extends('layout')

@section('title', 'Add or edit Student')

@section('content')
    <div class="d-flex justify-content-between">
        <h1>Student</h1>
        <a href="{{route('admin.logout')}}" class="btn d-flex align-items-center btn-outline-secondary">Logout</a>
    </div>

    <form class="input-group mb-3 w-25 d-flex flex-column mx-auto" method="post"
    action="{{isset($id) ? route('admin.updateStudent', ['id'=>$id]) : route('admin.storeStudent')}}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" type="text" class="form-control" value="{{$student['name'] ?? '' }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Birthday</label>
            <input name="birthday" type="date" class="form-control" value="{{$student['birthday'] ?? '' }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Math</label>
            <input name="math" type="number" class="form-control" value="{{$gradeMath['grade'] ?? '' }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Music</label>
            <input name="music" type="number" class="form-control" value="{{$gradeMusic['grade'] ?? '' }}">
        </div>
        <div class="mb-3">
            <label class="form-label">English</label>
            <input name="english" type="number" class="form-control" value="{{$gradeEnglish['grade'] ?? '' }}">
        </div>
        <div class="d-flex justify-content-center gap-2 px-5 py-2">
            @if(isset($id))
                <button disabled type="submit" class="btn btn-dark d-flex align-items-center">
                    Add
                </button>
                <button type="submit" class="btn btn-dark d-flex align-items-center">
                    Save
                </button>
            @else
                <button type="submit" class="btn btn-dark d-flex align-items-center">
                    Add
                </button>
                <button disabled type="submit" class="btn btn-dark d-flex align-items-center">
                    Save
                </button>
            @endif
        </div>
    </form>
    @if(session('success'))
        <p class="text-success display-4 text-center">{{session('success')}}</p>
        <div class="text-center">
            <a href="{{route('admin.studentList')}}">Student List</a>
        </div>
    @endif
@endsection
