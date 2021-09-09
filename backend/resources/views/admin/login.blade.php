<!-- Stored in resources/views/admin/login.blade.php -->

@push('styles')

    <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">

@endpush
@extends('layout.layout')

@section('title', __('login.title'))

@section('content')
    <form action="{{route('login')}}" method="post">
        @csrf
        <div>
            <h1>Login</h1>
        </div>
        <input name="username" placeholder="Username" type="text" value="{{old('username')}}">
        <input name="password" placeholder="Password" type="password">
        <button name="submit" type="submit">{{__('login.login')}}</button>
        <ul class="alert text-danger" style="margin-left: 1.5rem;">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </form>
@endsection
