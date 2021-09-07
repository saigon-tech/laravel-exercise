<!-- Stored in resources/views/child.blade.php -->


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/adminlogin.css') }}">

@endpush
@extends('layout.layout')

@section('title', 'Admin login')

@section('sidebar')
@endsection

@section('content')
    <form action="{{route('login')}}" method="post">
        @csrf
        <div>
            <h1>Login</h1>
        </div>
        <input name="username" placeholder="Username" type="text" value="{{old('username')}}">
        <input name="password" placeholder="Password" type="password">
        <button name="submit" type="submit">LOGIN</button>
        <ul class="alert text-danger" style="margin-left: 1.5rem;">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </form>
@endsection
