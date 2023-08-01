@extends('layout')

@section('title', 'Login')

@section('content')
    @parent
    <div class="login">
        <div class="form">
            <form class="login-form" action="/postLogin" method="post">
                @csrf
                <input name="username" type="text" placeholder="username"/>
                <input name="password" type="password" placeholder="password"/>
                <button type="submit">Login</button>
            </form>
        </div>
        @if(session('error'))
            <p class="text-danger">{{session('error')}}</p>
        @endif
    </div
@endsection
