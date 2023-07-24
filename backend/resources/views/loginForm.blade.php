@extends('layout')

@section('title', 'Login')
@push('styles')
    <link href="{{  asset('css/loginStyle.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="login-page">
        <div class="form">
            <form class="login-form" action="{{route('submitForm')}}" method="post">
            @csrf
            <input name="username" type="text" placeholder="username"/>
            <input name="password" type="password" placeholder="password"/>
            <button type="submit">Login</button>
            </form>
        </div>
        @if(session('error'))
            <p class="text-danger display-3 text-center">{{session('error')}}</p>
        @endif
    </div>
@endsection
