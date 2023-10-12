<!doctype html>
<html lang="en">

@include('layouts.head')

<body>
@yield('content')

@include('layouts.footer')
</body>

@stack('scripts')
</html>
