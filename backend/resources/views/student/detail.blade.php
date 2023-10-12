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
<div class="m3-3 w-1/2  mt-5 m-auto border rounded-lg py-20">
    @if($student===null)
        <h1 class="text-2xl my-3 font-bolder text-center">Add Student</h1>
        <form method="post" action={{route('student_create')}}>
            @csrf
            <div class="flex">
                <div class="w-3/5 m-auto flex gap-2 mb-2">
                    <label for="name" class="basis-1/3 p-2 h-full my-auto">Username:</label>
                    <input class="p-2 border rounded-md basis-2/3 focus:outline-none" type="text" id="name"
                           name="name" value=""
                    >
                </div>
            </div>
            @error('name')
            <div class="text-red-400 w-3/5 m-auto mb-2">{{ $message }}</div>
            @enderror
            <div class="flex flex-col">
                <div class="w-3/5 m-auto flex gap-2 mb-2">
                    <label for="birthday" class="basis-1/3 p-2 h-full my-auto">Birthday:</label>
                    <input type="text" id="birthday" name="birthday"
                           class=" p-2 border rounded-md basis-2/3 focus:outline-none" value="">
                </div>
            </div>
            @error('birthday')
            <div class="text-red-400 w-3/5 m-auto mb-2">{{ $message }}</div>
            @enderror

            @foreach($subjects as $subject => $value)
                <div class="w-3/5 m-auto flex gap-2 mb-2">
                    <label for="{{$subject}}"
                           class="basis-1/3 p-2 h-full my-auto">{{ ucfirst(strtolower($subject)) }}</label>
                    <input type="number" id="{{$subject}}" name="grades[{{$subject}}]"
                           class=" p-2 border rounded-md basis-2/3 focus:outline-none" min="0" max="10"
                           value=""
                    >
                </div>
            @endforeach
            <div class="flex justify-between px-5 w-3/5 m-auto mt-5">
                <button class="py-2 px-4 bg-green-500 text-center border rounded-md" type="submit">Create</button>
                <button class="py-2 px-4 bg-red-400 text-center border rounded-md" type="button">Cancel</button>
            </div>
        </form>

    @else
        <h1 class="text-2xl my-3 font-bolder text-center">Edit Student</h1>
        <form method="get" action={{route("student_update",$student)}}>
            @csrf
            <div class="flex">
                <div class="w-3/5 m-auto flex gap-2 mb-2">
                    <label for="name" class="basis-1/3 p-2 h-full my-auto">Username:</label>
                    <input class="p-2 border rounded-md basis-2/3 focus:outline-none" type="text" id="name"
                           name="name" value="{{$student->name}}"
                    >
                </div>
            </div>
            <div class="flex flex-col">
                <div class="w-3/5 m-auto flex gap-2 mb-2">
                    <label for="birthday" class="basis-1/3 p-2 h-full my-auto">Birthday:</label>
                    <input type="text" id="birthday" name="birthday"
                           class=" p-2 border rounded-md basis-2/3 focus:outline-none" value={{$student->birthday}}>
                </div>
            </div>

            @foreach($subjects as $subject => $value)
                <div class="w-3/5 m-auto flex gap-2 mb-2">
                    <label for="{{$subject}}"
                           class="basis-1/3 p-2 h-full my-auto">{{ ucfirst(strtolower($subject)) }}</label>
                    <input type="number" id="{{$subject}}" name="grades[{{$subject}}]"
                           class=" p-2 border rounded-md basis-2/3 focus:outline-none" min="0" max="10"
                           value={{$student->getGrade($value)}}
                    >
                </div>
            @endforeach
            <div class="flex justify-between px-5 w-3/5 m-auto mt-5">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <button class="py-2 px-4 bg-green-500 text-center border rounded-md" type="submit">Save</button>
                <button class="py-2 px-4 bg-red-400 text-center border rounded-md" type="button">Cancel</button>
            </div>
        </form>
    @endif

</div>
</body>
</html>
