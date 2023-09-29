<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="m3-3 w-1/2  mt-5 m-auto border rounded-lg py-20">
    <h1 class="text-2xl my-3 font-bolder text-center">Login</h1>
    <form method="post" action={{ route('post_login') }} >
        @csrf
        <div class="w-3/5 m-auto flex gap-2 mb-2">
            <label for="username" class="basis-1/3 p-2 h-full my-auto">Username:</label>
            <input type="text" id="username" name="username"
                   class=" p-2 border rounded-md basis-2/3 focus:outline-none" placeholder="admin">
        </div>
        <div class="w-3/5 m-auto flex gap-2 mb-5">
            <label for="password" class="basis-1/3 p-2 h-full my-auto">Password:</label>
            <input type="password" id="password" name="password"
                   class=" p-2 border rounded-md basis-2/3 focus:outline-none">
        </div>
        <div class="text-center">
            <button class="py-2 px-4 bg-green-500 text-center border rounded-md" type="submit">Login</button>
        </div>
    </form>
    @if($errors->any() )
        <div class="alert alert-danger w-6/12 text-red-500 m-auto mt-5">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>* {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('logged-in'))
        <div class="alert alert-danger w-6/12 text-red-300 m-auto">
            <ul>
                <li>* {{ session('logged-in') }}</li>
            </ul>
        </div>
    @endif
</div>
</body>
</html>
