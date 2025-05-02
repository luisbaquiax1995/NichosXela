<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @vite('resources/main.js')
</head>
<body>
@include('utils.alerts')
<div  class="bg-white flex items-center justify-center min-h-screen">
    <div class="p-6">
        <div class="flex lg:flex-3/12 justify-center m-6">
            <a href="#" class="-m-1.5 p-1.5">
                <span class="sr-only">Nichos Xela</span>
                <img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                     alt="nichos">
            </a>
        </div>
        @include('form-register')
    </div>

</div>


@vite('resources/js/focus-input.js')
@vite('resources/js/alerts.js')

</body>
</html>
