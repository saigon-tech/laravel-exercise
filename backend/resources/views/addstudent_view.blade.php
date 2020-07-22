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
    <h2 style="text-align: center;">Add Student Form</h2>
    <form id="myForm" action="{{route('student.create')}}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-row">
            <label class="col-sm-2 col-form-label" for="name">Name</label>
            <input type="text" class="form-control col-sm-10 @error('name') is-invalid @enderror" name="name"
                   value="{{old('name')}}"/>
            @error('name')
            <div class="col-sm-2"></div>
            <div class="alert alert-danger form-control col-sm-10">{{$message}}</div>
            @enderror
        </div>

        <div class="form-row" style="margin-top: 10px;">
            <label class="col-sm-2 col-form-label" for="birthday">Birthday</label>
            <input type="date" min="1980-01-01" max="2020-01-01"
                   class="form-control col-sm-10 @error('birthday') is-invalid @enderror" name="birthday"
                   value="{{old('birthday')}}"/>
            @error('birthday')
            <div class="col-sm-2"></div>
            <div class="alert alert-danger form-control col-sm-10">{{$message}}</div>
            @enderror
        </div>

        <div class="form-row" style="margin-top: 10px;">
            <label class="col-sm-2 col-form-label" for="math">Math</label>
            <select class="form-control col-sm-10" name="math">
                @for($i=1;$i<=10;$i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="form-row" style="margin-top: 10px;">
            <label class="col-sm-2 col-form-label" for="music">Music</label>
            <select class="form-control col-sm-10" name="music">
                @for($i=1;$i<=10;$i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="form-row" style="margin-top: 10px;">
            <label class="col-sm-2 col-form-label" for="english">English</label>
            <select class="form-control col-sm-10" name="english">
                @for($i=0;$i<=10;$i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="form-row col-sm-8" style="margin-top: 10px; margin-left: 165px; float: left">
            <button style="margin-right: 820px;" type="submit" class="btn btn-primary ">Create</button>
        </div>
    </form>

    <button style="float: right; margin-top: 10px;" class="btn btn-secondary" onclick="goBack()">Cancel</button>
</div>

</body>
</html>
<script>
    function goBack() {
        window.history.back();
    }

</script>
