<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="m3-3 w-1/2  mt-5 m-auto border rounded-lg py-10">
    <div class="flex justify-between px-5">
        <h1 class="text-2xl text-center font-bolder">Student</h1>
        @auth('admins')
            <a href="{{ route('logout') }}"
               class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 px-4 py-2 bg-red-300">Log
                out</a>
        @endauth
    </div>
    <form method="get" class="flex align-middle w-8/12 m-auto gap-5" action={{ route('student_list') }} >
        @csrf
        <label for="searchInput" class="item-center h-full my-auto">Name:</label>
        <div class="flex">
            <input id="searchInput" name="searchInput" placeholder="keyword"
                   class="p-2 border rounded-md w-50 focus:outline-none">
            <button type="submit" class=" px-4 bg-green-500 text-center border rounded-md">Search</button>
        </div>

    </form>
    <div class="flex flex-row-reverse px-5">
        <a class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 px-4 py-2 bg-red-300"" href={{route('student_get_create')}}>Add student</a>
    </div>
    <div class="w-8/12 m-auto mt-10">
        <table class="table-auto w-full border">
            <thead class="bg-slate-400">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Birthday</th>
                @foreach($subjects as $subject => $value)
                    <th>{{ ucfirst(strtolower($subject)) }}</th>
                @endforeach
                <th>GPA</th>
                <th>Pass</th>
                <th>Option</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr>
                    <td class="text-center">{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td class="text-center">{{ $student->birthday }}</td>
                    @foreach($subjects as $subject)
                        <td class="text-center">{{$student->getGrade($subject)}}</td>
                    @endforeach
                    <td class="text-center">{{ $student->grade_avg }}</td>
                    <td class="text-center">{{$student->checkPass()}}</td>
                    <td class="text-center">
                        <a class="btn btn-primary" href={{route('student_detail',$student)}}>Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-5">  {{ $students->links() }}</div>
    </div>
</div>
</body>
</html>