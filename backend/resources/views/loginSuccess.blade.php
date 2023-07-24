@extends('layout')

@section('title', 'Login')
@push('styles')
    <link href="{{  asset('css/loginStyle.css') }}" rel="stylesheet">
@endpush

@section('content')
    <h1 class="text-center">Login Success</h1>
    <a href="{{route('studentList')}}">Student List</a>
@endsection
