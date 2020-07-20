<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student List</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="product.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 style="text-align: center;">Add/Edit Student Form</h2>
    <form action="{{route('addstudent')}}" method="POST">
        @csrf
        <div class="form-row">
            <label class="col-sm-2 col-form-label"  for="name">Name</label>
            <input type="text" class="form-control col-sm-10" name="name"/>
        </div>
        <div class="form-row" style="margin-top: 10px;">
            <label class="col-sm-2 col-form-label"  for="birthday">Birthday</label>
            <input type="date" class="form-control col-sm-10" name="birthday"/>
        </div>
        <div class="form-row" style="margin-top: 10px;">
            <label class="col-sm-2 col-form-label"  for="math">Math</label>
            <input type="number" name="math" min="0" max="10" step="1">
        </div>
        <div class="form-row" style="margin-top: 10px;">
            <label class="col-sm-2 col-form-label"  for="music">Music</label>
            <input type="number" name="music" min="0" max="10" step="1">
        </div>
        <div class="form-row" style="margin-top: 10px;">
            <label class="col-sm-2 col-form-label"  for="english">English</label>
            <input type="number" name="english" min="0" max="10" step="1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
