<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add student</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
</head>

<body>
<div class="container">
    <br>

    <nav class="navbar">
        <a class="navbar-brand">Add student</a>
        <div class="logout">
            <button class="btn btn-outline-danger" onclick="window.location='{{route('logout')}}'">Logout</button>
        </div>
    </nav>
    <form class="form-group" method="post" action="create">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <label class="col-form-label">Name</label>
        <input style="text-transform: capitalize" type="text" class="form-control @error('name') is-invalid @enderror"
               name="name" required>
        @error('name')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror

        <label class="col-form-label">Birthday</label>
        <input type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" required>
        @error('birthday')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror

        <label class="col-form-label">Math</label>
        <select class="form-control" name="math" required>
            @for($i=0;$i<11;$i++)
                <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>

        <label class="col-form-label">Mucsic</label>
        <select class="form-control" name="music" required>
            @for($i=0;$i<11;$i++)
                <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>

        <label class="col-form-label">English</label>
        <select class="form-control" name="english" required>
            @for($i=0;$i<11;$i++)
                <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
        <br>
        <div class="row">
            <div class="col-10">
                <button class="btn btn-success" type="submit">Create</button>
            </div>
            <div class="col-2">
                <button class="btn btn-outline-secondary" onclick="window.location='{{route('getStudent')}}'">Cancel
                </button>
            </div>
        </div>
    </form>
</div>

</body>

</html>
