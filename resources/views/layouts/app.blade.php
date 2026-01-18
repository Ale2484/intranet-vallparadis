<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/svg+xml">
    {{-- Rich text --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        (function() {
            const html = document.documentElement;
            const savedTheme = localStorage.getItem("theme");
            if (!savedTheme) {
                if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
                    html.classList.add("dark");
                }
            } else if (savedTheme === "dark") {
            html.classList.add("dark");
            } else if (savedTheme === "light") {
            html.classList.remove("dark");
            }
        })();
    </script>
    @vite('resources/css/app.css')
    <title>@yield("title")</title>
</head>

<body class="bg-[#FFF9F6] dark:bg-neutral-950">
    @include('partials.icons')

    <header class="fixed top-0 left-0 flex items-start w-full h-auto z-10">
        <!-- Menu -->
        @include("components.navbar")
    </header>

    @include("partials.notifications")
    <main class="md:pr-20 md:pl-36 pt-24 px-5">
        @yield("main")
    </main>

    <footer class="px-24 mt-10">
        @include("components.footer")
    </footer>
    @include("partials.confirmable_modal")
</body>
@vite("resources/js/app.js")

</html>