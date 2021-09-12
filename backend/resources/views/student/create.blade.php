<!-- Stored in resources/views/student/create.blade.php -->
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/student/create.css') }}">
@endpush
@extends('layout.layout')
@section('title', __('student.create_title'))
@section('content')
    <form action="{{route('student.store')}}" method="post" id="modalForm">
        @csrf
        <div class="mb-4">
            <h4 class="modal-title" id="modalLabel">
                {{__('student.add')}}
            </h4>
            <hr>
        </div>
        <div class="mb-3">
            @error('name')<span>• {{$message}}</span><br/>@enderror
            <label for="name" class="form-label">{{__('student.name')}}</label>
            <input id="name" name="name" class="form-control" type="text" value="{{old('name')}}">
        </div>
        <div class="mb-3">
            @error('birthday')<span>• {{$message}}</span><br/>@enderror
            <label for="exampleInputPassword1" class="form-label">{{__('student.birthday')}}</label>
            <input id="birthday" name="birthday" class="form-control" type="date" value="{{old('birthday')}}">
        </div>
        <div class="mb-3">
            @error('math')<span>• {{$message}}</span><br/>@enderror
            <label class="form-label" for="math">{{__('student.math')}}</label>
            <select name="math" id="math" class="form-select" aria-label="math select">
                @for($i=1;$i<=10;$i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            @error('music')<span>• {{$message}}</span><br/>@enderror
            <label class="form-label" for="music">{{__('student.music')}}</label>
            <select name="music" id="music" class="form-select" aria-label="music select">
                @for($i=1;$i<=10;$i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            @error('english')<span>• {{$message}}</span><br/>@enderror
            <label class="form-label" for="english">{{__('student.english')}}</label>
            <select name="english" id="english" class="form-select" aria-label="english select"
                    value="{{old('english')}}">
                @for($i=1;$i<=10;$i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mb-4">
            <hr>
            <button type="submit" class="btn btn-primary" form="modalForm">{{__('student.save')}}</button>
        </div>
    </form>
@endsection
