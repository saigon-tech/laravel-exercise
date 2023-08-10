@extends('layout')

@section('title', 'Add or edit Student')

@section('content')
    <div class="d-flex justify-content-between">
        <h1>Student</h1>
        <a href="{{route('admin.logout')}}" class="btn d-flex align-items-center btn-outline-secondary">Logout</a>
    </div>
    @if(session('error'))
        {{ session('error') }}
    @enderror
    <form class="input-group mb-3 w-25 d-flex flex-column mx-auto" method="post"
          action="{{ isset($student) ? route('admin.updateStudent', $student) : route('admin.storeStudent') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" type="text" class="form-control" value="{{$student->name ?? '' }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Birthday</label>
            <input name="birthday" type="date" class="form-control" value="{{$student->birthday ?? '' }}">
        </div>
        @foreach(\App\Enums\GradeSubjectEnum::asArray() as $key => $subject)
            <div class="mb-3">
                <label class="form-label">{{ $subject }}</label>
                <input
                    name="{{ strtolower($key) }}"
                    type="number"
                    max="10"
                    class="form-control"
                    value="{{ isset($grades) ? $grades->get($subject) : 0 }}"
                >
            </div>
        @endforeach
        <div class="d-flex justify-content-center gap-2 px-5 py-2">
            <button type="submit" class="btn btn-dark d-flex align-items-center">
                {{ request()->routeIs('admin.storeStudent') ? 'Create' : 'Update' }}
            </button>
            <a href="{{route('admin.studentList')}}" class="btn btn-dark d-flex align-items-center">
                Cancel
            </a>
        </div>
    </form>
    @if(session('success'))
        <p class="text-success display-4 text-center">{{session('success')}}</p>
        <div class="text-center">
            <a href="{{route('admin.studentList')}}">Student List</a>
        </div>
    @endif
@endsection
