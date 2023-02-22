<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/icon type">
    <title>Dice It!</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Styles -->
    <style>
        * {
            background-color: #f5f5f5;
        }

        /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */
    </style>
</head>

<body class="bg-white h-screen">

    <div class="w-full flex flex-wrap">

        <!-- Login Section -->
        <div class="w-full md:w-1/2 flex flex-col">

            <div>

                <div class="max-w-7xl mx-auto p-6 lg:p-8 mt-20">
                    <div class="flex justify-center">
                        <img class="rounded-md" src="{{ asset('img/logo-text.png') }}" width="150" alt="Logo">

                    </div>

                </div>
            </div>
            <div>
                @yield('content')
            </div>

        </div>

        <!-- Image Section -->
        <div class="w-1/2 shadow-2xl">
            <img class="object-cover w-full h-screen hidden md:block" src="/img/bg.jpg">
        </div>
    </div>

</body>

</html>