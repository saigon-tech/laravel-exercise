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
    <h2 style="text-align: center;">Edit Student Form</h2>
    <form action="{{route('editstudent.edit')}}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-row">
            <label class="col-sm-2 col-form-label"  for="name">Name</label>
            <input type="text" class="form-control col-sm-10" name="name" value="@foreach($data as $item) {{$item->name}} @endforeach"/>
        </div>
        <div class="form-row" style="margin-top: 10px;">
            <label class="col-sm-2 col-form-label"  for="birthday">Birthday</label>
            <input type="text" class="form-control col-sm-10" name="birthday" value="@foreach($data as $item) {{$item->birthday}} @endforeach" />
        </div>
        <div class="form-row" style="margin-top: 10px;">
            <label class="col-sm-2 col-form-label"  for="math">Math</label>
            <select class="form-control col-sm-10" name="math" >
                @for($i=1;$i<=10;$i++)
                    <option value = "{{$i}}" @foreach($data as $item) @if($item->Math==$i) selected @endif @endforeach >
                        {{$i}}
                    </option>
                @endfor
            </select>
        </div>
        <div class="form-row" style="margin-top: 10px;">
            <label class="col-sm-2 col-form-label"  for="music">Music</label>
            <select class="form-control col-sm-10" name="music">
                @for($i=1;$i<=10;$i++)
                    <option value = "{{$i}}" @foreach($data as $item) @if($item->Music==$i) selected @endif @endforeach >
                        {{$i}}
                    </option>
                @endfor
            </select>
        </div>
        <div class="form-row" style="margin-top: 10px;">
            <label class="col-sm-2 col-form-label"  for="english">English</label>
            <select class="form-control col-sm-10" name="english">
                @for($i=1;$i<=10;$i++)
                    <option value = "{{$i}}" @foreach($data as $item) @if($item->English==$i) selected @endif @endforeach >
                        {{$i}}
                    </option>
                @endfor
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary"  name="idedit" style="float: right;" value="@foreach($data as $item) {{$item->id}} @endforeach">Submit</button>
    </form>
</div>

</body>
</html>
