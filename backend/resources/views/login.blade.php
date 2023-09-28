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
    <h1 class="text-2xl my-3 text-center">Login</h1>
    <form action="">
        <div class="w-3/5 m-auto flex gap-2 ">
            <label for="username" class="basis-1/3 p-2">Username:</label>
            <input type="text" id="username" name="username"
                   class=" my-2 p-2 border rounded-md basis-2/3 focus:outline-none" placeholder="admin">
        </div>
        <div class="w-3/5 m-auto flex gap-2 ">
            <label for="password" class="basis-1/3 p-2">Password:</label>
            <input type="password" id="password" name="password"
                   class=" my-2 p-2 border rounded-md basis-2/3 focus:outline-none">
        </div>
        <div class="text-center">
            <button class="py-2 px-4 bg-cyan-300 text-center border rounded-md">Login</button>
        </div>
    </form>
</div>
</body>
</html>
