@extends('layouts.master')

@section('content')
    <div class="m3-3 w-1/2  mt-5 m-auto border rounded-lg py-20">
        @if($student===null)
            <h1 class="text-2xl my-3 font-bolder text-center">Add Student</h1>
            <form method="post" action={{route('student.create')}}>
                @csrf
                <div class="flex">
                    <div class="w-3/5 m-auto flex gap-2 mb-2">
                        <label for="name" class="basis-1/3 p-2 h-full my-auto">Username:</label>
                        <input
                            class="p-2 border rounded-md basis-2/3 focus:outline-none"
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', '') }}"
                        >
                    </div>
                </div>
                @error('name')
                <div class="text-red-400 w-3/5 m-auto mb-2">{{ $message }}</div>
                @enderror
                <div class="flex flex-col">
                    <div class="w-3/5 m-auto flex gap-2 mb-2">
                        <label for="birthday" class="basis-1/3 p-2 h-full my-auto">Birthday:</label>
                        <input
                            type="date"
                            id="birthday"
                            name="birthday"
                            class=" p-2 border rounded-md basis-2/3 focus:outline-none"
                            value="{{ old('birthday', '') }}"
                        >
                    </div>
                </div>
                @error('birthday')
                <div class="text-red-400 w-3/5 m-auto mb-2">{{ $message }}</div>
                @enderror

                @foreach($subjects as $subject => $value)
                    <div class="w-3/5 m-auto flex gap-2 mb-2">
                        <label for="{{$subject}}"
                               class="basis-1/3 p-2 h-full my-auto">{{ ucfirst(strtolower($subject)) }}</label>
                        <input
                            type="number" id="{{$subject}}"
                            name="grades[{{$subject}}]"
                            class=" p-2 border rounded-md basis-2/3 focus:outline-none"
                            min="0"
                            max="10"
                            value="{{ old("grades.$subject") }}"
                        >
                    </div>
                    @error("grades.$subject")
                    <div class="text-red-400 w-3/5 m-auto mb-2">{{ $message }}</div>
                    @enderror
                @endforeach
                <div class="flex justify-between px-5 w-3/5 m-auto mt-5">
                    <button class="py-2 px-4 bg-green-500 text-center border rounded-md" type="submit">Create</button>
                    <a
                        class="btn py-2 px-4 bg-red-400 text-center border rounded-md"
                        href="{{ route('student.list') }}"
                    >
                        Cancel
                    </a>
                </div>
            </form>

        @else
            <h1 class="text-2xl my-3 font-bolder text-center">Edit Student</h1>
            <form method="get" action={{route('student.update',$student)}}>
                @csrf
                <div class="flex">
                    <div class="w-3/5 m-auto flex gap-2 mb-2">
                        <label for="name" class="basis-1/3 p-2 h-full my-auto">Username:</label>
                        <input
                            class="p-2 border rounded-md basis-2/3 focus:outline-none"
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $student->name) }}"
                        >
                    </div>

                    @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <div class="w-3/5 m-auto flex gap-2 mb-2">
                        <label for="birthday" class="basis-1/3 p-2 h-full my-auto">Birthday:</label>
                        <input
                            type="text"
                            id="birthday"
                            name="birthday"
                            class="p-2 border rounded-md basis-2/3 focus:outline-none"
                            value={{ old('birthday', $student->birthday) }}
                        >
                    </div>

                    @error('birthday')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                @foreach($subjects as $subject => $value)
                    <div class="w-3/5 m-auto flex gap-2 mb-2">
                        <label for="{{$subject}}"
                               class="basis-1/3 p-2 h-full my-auto">{{ ucfirst(strtolower($subject)) }}</label>
                        <input
                            type="number"
                            id="{{$subject}}"
                            name="grades[{{$subject}}]"
                            class="p-2 border rounded-md basis-2/3 focus:outline-none"
                            min="0"
                            max="10"
                            value={{ old("grades.$subject", $student->getGrade($value)) }}
                        >
                    </div>
                    @error ("grades.$subject")
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                @endforeach
                <div class="flex justify-between px-5 w-3/5 m-auto mt-5">
                    <button class="py-2 px-4 bg-green-500 text-center border rounded-md" type="submit">Save</button>
                    <a
                        class="btn py-2 px-4 bg-red-400 text-center border rounded-md"
                        href="{{ route('student.list') }}"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        @endif
    </div>
@endsection

