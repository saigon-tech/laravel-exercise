<!-- Base HTML5 Template for Auth user using laravel blade engine -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title', $title ?? 'Laravel')</title>
    @include('layouts.partials.head')
    @yield('styles')
</head>
<body>
<div id="app">
    <!-- main content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- main content -->
</div>
@include('layouts.partials.scripts')
@yield('scripts')
</body>
</html>
