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
@include('encargado.nav-encargado')
@include('utils.alerts')

<form class="p-6" method="post" enctype="multipart/form-data" action="{{ route('archivo.boleta') }}">
    @csrf
    <input type="hidden" value="{{ $correlativo }}" name="correlativo">
    <div class="flex items-center justify-center w-full">
        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-white-300 border-dashed rounded-lg cursor-pointer bg-white dark:hover:bg-gray-300 dark:bg-gray-100 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Haga clic para cargar archivo</span> o arrastre su archivo</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG, GIF or PDF (MAX. 800x400px)</p>
            </div>
            <input id="dropzone-file" type="file" class="" name="comprobante"  accept="application/pdf, image/svg+xml, image/png, image/jpg, image/jpeg, image/gif"/>
        </label>
    </div>
    <div class="mt-4 text-center">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            Subir archivo
        </button>
    </div>
</form>

@vite('resources/js/alerts.js')
</body>
</html>
