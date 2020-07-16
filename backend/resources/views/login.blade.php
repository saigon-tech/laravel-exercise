<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
</head>
<body>
<div class="container">
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $err )
                <li>{{$err}}</li>
            @endforeach
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif

    <form action="" method="POST" class="form-signin">
        <div class="text-center">
        @csrf
        <label for="username" class="sr-only">Username</label>
        <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
        <label for="pwd" class="sr-only">Password</label>
        <input type="password" id="pwd" class="form-control" placeholder="Enter Password" name="password">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">laravel-exercise</p>
        </div>
    </form>
</div>
</body>
</html>
