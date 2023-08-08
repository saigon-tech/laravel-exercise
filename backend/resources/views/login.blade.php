@extends('layout')

@section('title', 'Login')

@section('content')
    @parent

    <div class="login">
        <div class="d-flex justify-content-center" style="margin-bottom:20px"><h4>Login</h4></div>
        <div>
            @foreach($errors->all() as $error)
                <p class="text-danger text-center">{{ $error }}</p>
            @endforeach
            @if(session('error'))
                <p class="text-danger text-center">{{session('error')}}</p>
            @endif
        </div>
        <div class="form">
            <form class="login-form" action="{{ route('postLogin') }}" method="post">
                @csrf
                <div class="d-flex flex-column align-items-center">
                    <div><label for="username">Username:</label> <input name="username" type="text" class="form-control"/></div>
                    <div><label for="password">Password:</label> <input name="password" type="password" class="form-control"/></div>
                </div>
                <div class="d-flex justify-content-center" style="margin-top:20px">
                    <button class="btn btn-dark" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div
@endsection
