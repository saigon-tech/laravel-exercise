<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Add Student</h2>
    <button style="float: right"><a href="{{route('logout')}}">Logout</a></button>
    <div class="form">
    </div>
    <form class="form-horizontal" action="{{route('add')}}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="birthday">BirthDay:</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="birthday" placeholder="Enter birthday" name="birthday">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="Math">Math:</label>
            <div class="col-sm-10">
                <select class="form-control" name="Math">
                    @for($i=1;$i<=10;$i++)
                        <option value = "{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="Music">Music:</label>
            <div class="col-sm-10">
                <select class="form-control" name="Music">
                    @for($i=1;$i<=10;$i++)
                        <option value = "{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="English">English:</label>
            <div class="col-sm-10">
                <select class="form-control" name="English">
                    @for($i=1;$i<=10;$i++)
                        <option value = "{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="form-group">
            <button style="float: right" type="submit" class="btn btn-success">Create or Save</button>
        </div>
    </form>
    <button class="btn btn-default" style="float: right;"><a href="{{route('student')}}">Cancel</a></button>
</div>

</body>
</html>
