<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>StudentList</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row1">
        <div class="container">
        <div class="col-lg-6" style="float: left;">
            <form class="form-inline my-2 my-lg-0" method="post">
                @csrf
                <lable>Name</lable>
                <input style="margin-left: 5px;" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
            <div class="btn btn-outline-success"><a href="{{route('logout')}}"; style="text-decoration: none; color: #4dc0b5;font-size: medium;" >Logout</a></div>
        </div>


        <div class="btn btn-outline-success" style="float: right; margin-top: 100px;"><a style="text-decoration: none; color: #4dc0b5;font-size: medium;" >Add student</a></div>
    </div>
    <div class="row2">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Birthday</th>
                <th scope="col">Math</th>
                <th scope="col">Music</th>
                <th scope="col">English</th>
                <th scope="col">GPA</th>
                <th scope="col">Pass</th>
            </tr>
            <?php $no=1?>
            @foreach($students as $student)
                @php
                   $x = $student->subjects->where('subject',1)->first();
                    if ($x != NULL)
                    $x = $x->grade;
                    elseif ($x == NULL)
                        $x = 0;
                   $y = $student->subjects->where('subject',2)->first();
                    if ($y != NULL)
                    $y = $y->grade;
                    elseif ($y == NULL)
                        $y = 0;
                    $z = $student->subjects->where('subject',3)->first();
                    if ($z != NULL)
                    $z = $z->grade;
                    elseif ($z == NULL)
                        $z = 0;
                    $e = round(($x+$y+$z)/3,1);
                @endphp
                <tr>
                    <td><?= $no++ ?></td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->birthday}}</td>
                    <td>{{$x}}</td>
                    <td>{{$y}}</td>
                    <td>{{$z}}</td>
                    <td>{{$e}}</td>
                    @if ($e>5)
                        <td>Passed</td>
                    @else
                    <td>Failed</td>
                    @endif
                </tr>
            @endforeach
            </thead>
        </table>
        {{ $students->links()}}
    </div>
</div>
</body>
</html>
