<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Login</h2>
    @if($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{$message}}</strong>
        </div>
    @endif
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Enter Username" name="username">
        </div>
        @error('username')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control form-control @error('password') is-invalid @enderror" id="pwd" placeholder="Enter password" name="password">
        </div>
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @if(session('thongBao'))
            <div class="alert alert-danger">{{session('thongBao')}}</div>
        @endif
        <div class="form-group form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember"> Remember me
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</body>
</html>
