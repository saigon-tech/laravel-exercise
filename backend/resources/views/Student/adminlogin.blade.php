<!-- Stored in resources/views/child.blade.php -->


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/adminlogin.css') }}">

@endpush
@extends('Layout.layout')

@section('title', 'Admin login')

@section('sidebar')
{{--    <div class="top-left links">--}}
{{--        <a href="/">BACK</a>--}}
{{--    </div>--}}
@endsection

@section('content')
    <form method="post">
        @csrf
        <div>
            <h1>Login</h1>
            @if (session('msg'))
                <div class="alert alert-danger">
                    {{ session('msg') }}
                </div>
            @endif
        </div>
        <input name="username" placeholder="Username" type="text" required="" class="@error('username') is-invalid @enderror">
        <input name="password" placeholder="Password" type="password" required="" class="@error('password') is-invalid @enderror">
        <button name="submit" type="submit">LOGIN</button>
    </form>
@endsection
