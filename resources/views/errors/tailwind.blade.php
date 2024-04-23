<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 36px;
            padding: 20px;
        }

        .text-gray-900 {
            --tw-text-opacity: 1;
            color: rgb(61 61 61 / var(--tw-text-opacity));
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity));
        }

        .dark\:bg-gray-900:is(.dark *) {
            --tw-bg-opacity: 1;
            background-color: rgb(61 61 61 / var(--tw-bg-opacity));
        }

        .py-8 {
            padding-top: 2rem
                /* 32px */
            ;
            padding-bottom: 2rem
                /* 32px */
            ;
        }

        .px-4 {
            padding-left: 1rem
                /* 16px */
            ;
            padding-right: 1rem
                /* 16px */
            ;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .max-w-screen-md {
            max-width: 768px;
        }

        .text-center {
            text-align: center;
        }

        .mb-4 {
            margin-bottom: 1rem
                /* 16px */
            ;
        }

        .text-4xl {
            font-size: 2.25rem
                /* 36px */
            ;
            line-height: 2.5rem
                /* 40px */
            ;
        }

        @media (min-width: 1024px) {
            .lg\:py-16 {
                padding-top: 4rem
                    /* 64px */
                ;
                padding-bottom: 4rem
                    /* 64px */
                ;
            }

            .lg\:px-12 {
                padding-left: 3rem
                    /* 48px */
                ;
                padding-right: 3rem
                    /* 48px */
                ;
            }

            .lg\:mb-6 {
                margin-bottom: 1.5rem
                    /* 24px */
                ;
            }
        }

        @media (min-width: 768px) {
            .md\:text-5xl {
                font-size: 3rem
                    /* 48px */
                ;
                line-height: 1;
            }

            .md\:text-lg {
                font-size: 1.125rem
                    /* 18px */
                ;
                line-height: 1.75rem
                    /* 28px */
                ;
            }
        }

        @media (min-width: 1280px) {
            .xl\:text-6xl {
                font-size: 3.75rem
                    /* 60px */
                ;
                line-height: 1;
            }

            .xl\:text-xl {
                font-size: 1.25rem
                    /* 20px */
                ;
                line-height: 1.75rem
                    /* 28px */
                ;
            }
        }

        .font-bold {
            font-weight: 700;
        }

        .tracking-tight {
            letter-spacing: -0.025em;
        }

        .leading-none {
            line-height: 1;
        }

        .text-gray-900 {
            --tw-text-opacity: 1;
            color: rgb(61 61 61 / var(--tw-text-opacity));
        }

        .dark\:text-white:is(.dark *) {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity));
        }

        .font-light {
            font-weight: 300;
        }

        .text-gray-500 {
            --tw-text-opacity: 1;
            color: rgb(109 109 109 / var(--tw-text-opacity));
        }

        .dark\:text-gray-400:is(.dark *) {
            --tw-text-opacity: 1;
            color: rgb(132 132 132 / var(--tw-text-opacity));
        }

        .w-10 {
            width: 2.5rem
                /* 40px */
            ;
        }

        .h-10 {
            height: 2.5rem
                /* 40px */
            ;
        }

        .mb-4 {
            margin-bottom: 1rem
                /* 16px */
            ;
        }
    </style>
</head>

<body>

    <div class="flex-center position-ref full-height">
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-16 lg:px-12">
                @yield('icon')
                <h1
                    class="mb-4 mt text-4xl font-bold tracking-tight leading-none text-gray-900 lg:mb-6 md:text-5xl xl:text-6xl dark:text-white">
                    @yield('title')</h1>
                <p class="font-light text-gray-500 md:text-lg xl:text-xl dark:text-gray-400">@yield('message')</p>
                @yield('action')
            </div>
        </section>

    </div>
</body>

</html>
