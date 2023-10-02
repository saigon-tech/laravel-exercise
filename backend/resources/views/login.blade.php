<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login </title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="max-w-screen-md mx-auto m-10 border">
        <h1 class="text-center font-bold text-4xl my-5">Login</h1>

        <div>
            <form action="{{ route('login') }}" method="post" class="mx-auto w-4/5 p-10">
                @csrf
                <div class="flex items-center">
                    <label for="username" class="block w-32">Username:</label>
                    <input type="text" id="username" placeholder="admin" name="username" class="grow w-full rounded border px-2 py-1"/>
                </div>
                <div class="mt-4 flex items-center">
                    <label for="password" class="block w-32">Password:</label>
                    <input type="password" id="password" name="password" class="grow w-full border rounded px-2 py-1" />
                </div>
                @if(session('error'))
                    <p class="text-red-600 mt-2">{{session('error')}}</p>
                @endif
                <button class="block px-6 py-2 text-white rounded-md bg-green-500 border mt-8 mx-auto">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
