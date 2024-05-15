<!DOCTYPE html>
<html
    data-theme="sunset"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap"
            rel="stylesheet"
        />
        <title>Laravel</title>

        @vite('../../../resources/css/app.css')
    </head>

    <body class="space-grotesk">
        <div class="min-h-screen flex flex-col">
            @include('layout.nav')
            <div class="w-full container mx-auto max-w-5xl lg:py-10">
                @yield('content')
            </div>
        </div>
    </body>
</html>
