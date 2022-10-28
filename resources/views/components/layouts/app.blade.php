<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>{{$title}}</title>
</head>
<body>
<x-layouts.navigation/>
<main class="max-w-[60ch] mx-auto w-full my-4 px-4">
    {{$slot}}
</main>
{{--<footer class="bg-white border-t border-stone-300 p-4">
    Developed with Laravel and Tailwind
</footer>--}}
<script src="https://kit.fontawesome.com/07b8df4631.js" crossorigin="anonymous"></script>
</body>
</html>
