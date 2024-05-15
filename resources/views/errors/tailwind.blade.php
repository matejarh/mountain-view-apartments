<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    @include('errors.css')
</head>


<body class="antialiased">
    @php
        if (!isset($background)) {
            $background = 'background.jpg';
        }
    @endphp

    <div class="relative flex items-top justify-center min-h-screen w-screen bg-gray-600 dark:bg-gray-950 sm:items-center sm:pt-0 bg-cover bg-blend-multiply "
        style="background-image: url({{ Vite::asset('resources/images/errors/' . $background) }})">
        <section class=" rounded-lg shadow-lg bg-opacity-60 dark:bg-opacity-60 backdrop-blur-lg">
            <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-16 lg:px-12">
                @yield('icon')
                <h1
                    class="mb-4 mt text-4xl font-bold tracking-tight leading-none text-gray-200 lg:mb-6 md:text-5xl xl:text-6xl dark:text-white">
                    @yield('title')</h1>
                <p class="font-light text-gray-200 md:text-lg xl:text-xl dark:text-gray-100">@yield('message')</p>
                @yield('action')
            </div>
        </section>

    </div>

    <script>
        window.addEventListener("load", (event) => {
            let isDark = localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) &&
                window.matchMedia('(prefers-color-scheme: dark)').matches)

            if (isDark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');

            }

            /*             let lang= localStorage.getItem('language') || navigator.language.split('-')[0]
                        document.documentElement.setAttribute('lang', lang) */
        })
    </script>
</body>

</html>
