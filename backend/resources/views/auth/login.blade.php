<!-- extends from layouts.auth -->
@extends('layouts.auth')

<!-- page title -->
@section('title', 'Login')

<!-- page content -->
@section('content')
    <!-- login form using bootstrap -->
    <form class="form-signin" method="POST" action="{{ route('login') }}">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal text-center">Please sign in</h1>
        <!-- display flash messages -->
        @include('layouts.partials.flash')
        <!-- display flash messages -->
        <!-- email input -->
        <div class="form-group">
            <label for="username" class="sr-only">Username</label>
            <input type="text" id="username" name="username"
                   class="form-control @error('username') is-invalid @enderror"
                   placeholder="Your username" value="{{ old('username') }}" required autocomplete="off" autofocus>
            @error('username')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <!-- password input -->
        <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password" required autocomplete="current-password">
            @error('password')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>

        <!-- login button -->
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

    </form>

@endsection

