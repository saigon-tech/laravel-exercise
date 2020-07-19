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
    <h2>Edit</h2>
    <button style="float: right"><a href="{{route('logout')}}">Logout</a></button>
    <form class="form-horizontal" action="{{route('edit.edit')}}" method="post">
        <div class="form-group">
            {{ csrf_field() }}
            <label class="control-label col-sm-2" for="name">Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="@foreach($data as $dt) {{$dt->name}} @endforeach" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="birthday">BirthDay:</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name="birthday" value="@foreach($data as $dt) {{$dt->birthday}} @endforeach" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="Math">Math:</label>
            <div class="col-sm-10">
                <select class="form-control" name="Math">
                    @for($i=1;$i<=10;$i++)
                        <option value = "{{$i}}" @foreach($data as $dt) @if($dt->Math==$i) selected @endif @endforeach >
                            {{$i}}
                        </option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="Music">Music:</label>
            <div class="col-sm-10">
                <select class="form-control" name="Music">
                    @for($i=1;$i<=10;$i++)
                        <option value = "{{$i}}" @foreach($data as $dt) @if($dt->Music==$i) selected @endif @endforeach >
                            {{$i}}
                        </option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="English">English:</label>
            <div class="col-sm-10">
                <select class="form-control" name="English">
                    @for($i=1;$i<=10;$i++)
                        <option value = "{{$i}}" @foreach($data as $dt) @if($dt->English==$i) selected @endif @endforeach >
                            {{$i}}
                        </option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default"name="id" style="float: right;" value="@foreach($data as $dt) {{$dt->id}} @endforeach">Edit</button>
            </div>
        </div>
    </form>
    <button class="btn btn-default" style="float: right;"><a href="{{route('student')}}">Cancel</a></button>
</div>

</body>
</html>
