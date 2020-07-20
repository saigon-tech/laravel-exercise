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
    <div class="row1">
        <div class="col-lg-6" style="float: left;">
            <form class="form-inline my-2 my-lg-0" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <lable>Searching By Name</lable>
                <input style="margin-left: 5px;" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>

            <div style="float: right"><a href="{{route('logout')}}">Logout</a></div>
        <br>

        <div class="btn btn-outline-success" style="float: right; margin-top: 100px;"><a href="{{route('addstudent')}}" style="text-decoration: none; color: #4dc0b5;font-size: medium;" >Add student</a></div>
    </div>
    <div class="row2" id="employee_table">

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col"><a id="clumn_" onclick="value_sort()" href="#" >Name</a></th>
                    <input type="hidden" id="value_changle" value="DESC">
                    <th scope="col">Birthday</th>
                    <th scope="col">Math</th>
                    <th scope="col">Music</th>
                    <th scope="col">English</th>
                    <th scope="col">GPA</th>
                    <th scope="col">Pass</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $i=1;

                @endphp
                @foreach($data as $item)
                <tr>
                    <th>{{$i}}</th>
                    <td><a href="{{route('editstudent', ['id' => $item->id])}}">{{$item->name}}</a></td>
                    <td>{{\DateTime::createFromFormat('Y-m-d', $item->birthday)->format('Y/m/d')}}</td>
                    <td>{{$item->Math}}</td>
                    <td>{{$item->Music}}</td>
                    <td>{{$item->English}}</td>
                    <td>{{round(($item->Math+$item->Music+$item->English)/3,1)}}</td>
                    @php
                        $i+=1;
                        $pass = ($item->Math+$item->Music+$item->English)/3;
                    @endphp
                    @if($pass > 5)
                        <td>Y</td>
                    @else
                        <td>N</td>
                    @endif
                </tr>
                @endforeach
                </tbody>
            </table>

    </div>
    <div style="float: right;">{{ $data->links() }}</div>
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
