<!-- Stored in resources/views/child.blade.php -->


@push('styles')

    <link rel="stylesheet" href="{{ asset('css/createform.css') }}">

@endpush
@extends('layout.layout')

@section('title', 'Admin login')

@section('sidebar')
    <div class="top-left links">
        <a href="{{route('student.index')}}">< BACK</a>
    </div>
    <div class="top-right links">
        <a>User:
            @if($admin)
                {{$admin}}
            @endif
        </a>

        <a href="{{route('logout')}}">LOGOUT</a>
    </div>
@endsection

@section('content')
    <form action="{{route('student.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <h1 id="header"></h1>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" name="name" class="form-control" type="text" required="">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Birthdate</label>
            <input id="name" name="birthday" class="form-control" type="date" required="">
        </div>
        <div class="mb-3">
            <label class="form-label" for="math">Math</label>
            <select name="math" id="math" class="form-select" aria-label="math select">
                @for($i=1;$i<=10;$i++)
                    <option value="{{$i}}" selected? {{$i}}==1:>{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="music">Music</label>
            <select name="music" id="music" class="form-select" aria-label="music select">
                @for($i=1;$i<=10;$i++)
                    <option value="{{$i}}" selected? {{$i}}==1:>{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="english">English</label>
            <select name="english" id="english" class="form-select" aria-label="english select">
                @for($i=1;$i<=10;$i++)
                    <option value="{{$i}}" selected? {{$i}}==1:>{{$i}}</option>
                @endfor
            </select>
        </div>
        <button id="submit" name="submit" type="submit" class="btn btn-primary">Submit</button>
        <ul class="alert text-danger" style="margin-left: 1.5rem;">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </form>
@endsection
@push('js')
    <script>
        document.getElementById("header").textContent = "{{ $header }}";
    </script>
@endpush
