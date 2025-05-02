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
@php
    $usuario = session('usuario')
@endphp
@if($usuario->rol_id == \App\enums\TipoRol::AUDITOR)
    @include('auditor.nav-auditor')
@endif
@include('utils.alerts')
<div>
    @include('auditor.table-contratos')
</div>
@vite('resources/js/alerts.js')
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
