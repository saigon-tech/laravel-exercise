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
    
        <form class="input-group mb-3 w-25 d-flex flex-column mx-auto" method="post" action="{{route('studentStore')}}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="name" type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Birthday</label>
                <input name="birthday" type="date" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Math</label>
                <input name="math" type="number" class="form-control" min="0" max="10" >
            </div>
            <div class="mb-3">
                <label class="form-label">Music</label>
                <input name="music" type="number" class="form-control" min="0" max="10" >
            </div>
            <div class="mb-3">
                <label class="form-label">English</label>
                <input name="english" type="number" class="form-control" min="0" max="10" >
            </div>
            <div class="d-flex justify-content-center gap-2 px-5 py-2">
                <button type="submit" class="btn btn-primary d-flex align-items-center">Create</button>
            </div>
        </form>
    @if(session('success'))
        <p class="text-success display-3 text-center">{{session('success')}}</p>
    @endif
@endsection
