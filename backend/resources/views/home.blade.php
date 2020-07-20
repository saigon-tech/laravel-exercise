<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student management</title>
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
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>

<body>
<div class="container">
    <br/>
    <nav class="navbar">
        <a class="navbar-brand">Student</a>
        <div class="logout">
            <button class="btn btn-outline-danger" onclick="window.location='{{route('logout')}}'">Logout</button>
        </div>
    </nav>

    <form class="form-inline my-2 my-lg-0" method="get" action="search">
        Name:<input style="text-transform: capitalize" id="search" class="form-control mr-sm-2" type="search"
                    placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

    <div class="btnAdd">
        <button class="btn btn-primary" onclick="window.location='{{route('getCreateStudent')}}'">Add Student</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="myTable">
                <thead>
                <tr>
                    <th scope="col" onclick="window.location='{{route('getStudent')}}'" id="id">No</th>
                    <th scope="col" id="name"
                        onclick="window.location='{{route('sort',['direct' => $sorted ])}}'"
                    ><a style="color: #1b1e21" href="#">Name</a>
{{--                        <a href="{{$sorted}}">Name</a>--}}
                    </th>
                    <th scope="col">Birthday</th>
                    <th scope="col">Math</th>
                    <th scope="col">Music</th>
                    <th scope="col">English</th>
                    <th scope="col">GPA</th>
                    <th scope="col">Pass</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $st)
                    <tr class="clickable-row" data-href="{{route('getEditStudent', ['id' => $st->id])}}">
                        <td>{{$st->id}}</td>
                        <td style="text-transform: capitalize">{{$st->name}}</td>
                        <td>{{DateTime::createFromFormat('Y-m-d',$st->birthday)->format('Y/m/d')}}</td>
                        <td>{{$st->Math}}</td>
                        <td>{{$st->Music}}</td>
                        <td>{{$st->English}}</td>
                        <td>{{number_format($tb=($st->Math+$st->Music+$st->English)/3,1)}}</td>
                        @if($tb>5)
                            <td>Yes</td>
                        @else
                            <td>No</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="btnAdd">{{ $data->links() }}</div>
    </div>
</div>
</div>

<script>
    // $(document).ready(function () {
    //     $('#myTable').DataTable();
    //
    // });

    {{--$('#search').on('keyup', function () {--}}
    {{--    $value = $(this).val();--}}
    {{--    $.ajax({--}}
    {{--        type: 'get',--}}
    {{--        url: '{{ URL::to('quickSearch') }}',--}}
    {{--        data: {--}}
    {{--            'search': $value--}}
    {{--        },--}}
    {{--        success: function (data) {--}}
    {{--            $('tbody').html(data);--}}
    {{--        }--}}
    {{--    });--}}
    {{--})--}}

    jQuery(document).ready(function ($) {
        $(".clickable-row").click(function () {
            window.location = $(this).data("href");
        });
    });

    function url() {
        var url = window.location.pathname;
        return url;
    }
</script>
</body>

</html>
