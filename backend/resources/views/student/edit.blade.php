<!-- Stored in resources/views/student/edit.blade.php -->
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/student/create.css') }}">
@endpush
@extends('layout.layout')
@section('title', __('student.edit_title'))
@section('content')
    <form action="{{route('student.update', $student->id)}}" method="post" id="modalForm">
        @csrf
        <div class="mb-4">
            <h4 class="modal-title">
                {{__('student.edit')}}
            </h4>
            <hr>
        </div>
        <div class="mb-3">
            @error('name')<span>• {{$message}}</span><br/>@enderror
            <label for="name" class="form-label">{{__('student.name')}}</label>
            <input id="name" name="name" class="form-control" type="text" value="{{$student->name}}">
        </div>
        <div class="mb-3">
            @error('birthday')<span>• {{$message}}</span><br/>@enderror
            <label for="exampleInputPassword1" class="form-label">{{__('student.birthday')}}</label>
            <input id="birthday" name="birthday" class="form-control" type="date" value="{{$student->birthday}}">
        </div>
        <div class="mb-3">
            @error('math')<span>• {{$message}}</span><br/>@enderror
            <label class="form-label" for="math">{{__('student.math')}}</label>
            <select name="math" id="math" class="form-select" aria-label="math select">
                @for($i=1;$i<=10;$i++)
                    @if($i==$student->math)
                        <option value="{{$i}}" selected>{{$i}}</option>
                    @else
                        <option value="{{$i}}">{{$i}}</option>
                    @endif
                @endfor
            </select>
        </div>
        <div class="mb-3">
            @error('music')<span>• {{$message}}</span><br/>@enderror
            <label class="form-label" for="music">{{__('student.music')}}</label>
            <select name="music" id="music" class="form-select" aria-label="music select">
                @for($i=1;$i<=10;$i++)
                    @if($i==$student->music)
                        <option value="{{$i}}" selected>{{$i}}</option>
                    @else
                        <option value="{{$i}}">{{$i}}</option>
                    @endif
                @endfor
            </select>
        </div>
        <div class="mb-3">
            @error('english')<span>• {{$message}}</span><br/>@enderror
            <label class="form-label" for="english">{{__('student.english')}}</label>
            <select name="english" id="english" class="form-select" aria-label="english select">
                @for($i=1;$i<=10;$i++)
                    @if($i==$student->english)
                        <option value="{{$i}}" selected>{{$i}}</option>
                    @else
                        <option value="{{$i}}">{{$i}}</option>
                    @endif
                @endfor
            </select>
        </div>
        <div class="mb-4">
            <hr>
            <button type="submit" class="btn btn-primary" form="modalForm">{{__('student.save')}}</button>
        </div>
        {{method_field('PUT')}}
    </form>
@endsection
