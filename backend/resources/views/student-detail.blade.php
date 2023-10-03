<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="m3-3 w-1/2  mt-5 m-auto border rounded-lg py-10">
    <div class="flex justify-between px-5">
        <h1 class="text-2xl text-center font-bolder">Student</h1>
        <button class="px-4 bg-red-500 text-center border rounded-md py-2">Logout</button>
    </div>
    <form method="get" class="flex align-middle w-8/12 m-auto gap-5" action={{ route('student_search') }} >
        @csrf
        <label for="searchInput" class="item-center h-full my-auto">Name:</label>
        <div class="flex">
            <input id="searchInput" name="searchInput" placeholder="keyword"
                   class="p-2 border rounded-md w-50 focus:outline-none">
            <button type="submit" class=" px-4 bg-green-500 text-center border rounded-md" >Search</button>
        </div>

    </form>
    <div class="flex flex-row-reverse px-5">
        <button class="px-4 py-2 bg-green-500 text-center border rounded-md">Add Student</button>
    </div>
    <div class="w-8/12 m-auto mt-10">
        <table class="table-auto w-full border">
            <thead class="bg-slate-400">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Math</th>
                <th>Music</th>
                <th>English</th>
                <th>GPA</th>
                <th>Pass</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr>
                    <td class="text-center">{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td class="text-center">{{ $student->birthday }}</td>

                    @foreach($student->grades->sortBy('subject') as $grade)
                        <td class="text-center">{{$grade->grade}}</td>
                    @endforeach
                    <td>{{round($student->grades->avg('grade'),1)}}</td>
                    @if($student->grades->avg('grade')>5)
                        <td class="text-center">Y</td>
                    @else
                        <td class="text-center">N</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-5">  {{ $students->links() }}</div>

    </div>

</div>
</body>
</html>
