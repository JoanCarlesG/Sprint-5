<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/icon type">
    <title>Dice It!</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <!-- Styles -->
    <style>
        * {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body class="bg-white h-screen">

    <div class="w-full flex flex-wrap">
        <!-- Image Section -->
        <div class="w-1/4 shadow-2xl">
            <img class="object-cover w-full h-screen hidden md:block" src="/img/bg.jpg">
        </div>

        <!-- App Section -->
        <div class="w-full md:w-2/4 flex flex-col">
            <div>
                @yield('content')
            </div>
        </div>

        <!-- Image Section -->
        <div class="w-1/4 shadow-2xl">
            <img class="object-cover w-full h-screen hidden md:block" src="/img/bg.jpg">
        </div>
    </div>

</body>

</html>