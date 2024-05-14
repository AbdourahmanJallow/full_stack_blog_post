<!DOCTYPE html>
<html
    data-theme="synthwave"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Laravel</title>

        @vite('../../../resources/css/app.css')
    </head>

    <body class="font-mono">
        <div class="min-h-screen flex flex-col">
            @include('layout.nav')
            <div class="w-full container mx-auto max-w-5xl lg:py-10">
                @yield('content')
            </div>
        </div>
    </body>
</html>
