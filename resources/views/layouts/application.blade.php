<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>@yield("title")</title>
</head>
<body class="baseColor">
    <nav>
    </nav>
    <main>
        @yield("main")
    </main>
    <footer>
        @yield("footer")
    </footer>
</body>
</html>