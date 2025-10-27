<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/svg+xml">

    @vite('resources/css/app.css')
    <title>@yield("title")</title>
</head>

<body class="bg-[#FFF9F6]">
    @include('partials.icons')
    
    <header class="fixed top-0 left-0 flex items-start w-full h-auto z-10">
        <!-- Menu -->
        @include("components.navbar")
    </header>

    @include("partials.notifications")
    <main class="pr-24 pl-36 pt-24">
        @yield("main")
    </main>
    
    <footer class="px-24">
        @include("components.footer")
    </footer>
    @include("partials.confirmable_modal")
</body>
@vite("resources/js/app.js")

</html>