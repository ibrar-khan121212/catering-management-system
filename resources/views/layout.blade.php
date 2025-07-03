<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Catering System')</title>
    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
</head>
<body>
    <div class="container min-w-screen">
        @yield('content')
    </div>
</body>
</html>