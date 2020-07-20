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
    <h2>Students</h2>
    <button style="float: right"><a href="{{route('logout')}}">Logout</a></button>
    <button style="float: right"><a href="{{route('add')}}">Add Student</a></button>
    <div class="search-container">
        <form action="" method="post">
            {{ csrf_field() }}
            <lable>Searching By Name:</lable>
            <input type="search" placeholder="Search.." aria-label="Search" name="search">
            <button type="submit">Search</button>
        </form>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>NO</th>
            <th><a onclick="value_sort()" data-oder="DESC">Name</a></th>
            <input type="hidden" id="value_changle" value="DESC">
            <th>Birthday</th>
            <th>Math</th>
            <th>Music</th>
            <th>English</th>
            <th>GPA</th>
            <th>Pass</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i=1;
        @endphp

        @foreach($data as $dt)
            <tr>
                <td>{{$i}}</td>
                <td><a href="{{route('edit', ['id' => $dt->id])}}">{{$dt->name}}</a></td>
                <td>{{\DateTime::createFromFormat('Y-m-d', $dt->birthday)->format('Y/m/d')}}</td>
                <td>{{$dt->Math}}</td>
                <td>{{$dt->Music}}</td>
                <td>{{$dt->English}}</td>
                <td>{{($dt->Math+$dt->Music+$dt->English)/3}}</td>
                @php
                    $i+=1;
                    $pass = ($dt->Math+$dt->Music+$dt->English)/3;
                @endphp
                @if($pass > 5 )
                    <td>Y</td>
                @elseif($pass <= 5)
                    <td>N</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    <div style="float: right;" class="search-container">{{ $data->links() }}</div>
</div>
</body>
</html>
<script>
    function value_sort() {
        var x = $('#value_changle').val();
        $('#value_changle').val(x == "ASC" ? "DESC" : "ASC");
        $.ajax({
            type: 'get',
            url: '{{\Illuminate\Support\Facades\URL::to('student')}}',
            data: {
                'sort' : x
            },
            success: function (data) {
                $('tbody').html(data);
            }
        });
    }
</script>
