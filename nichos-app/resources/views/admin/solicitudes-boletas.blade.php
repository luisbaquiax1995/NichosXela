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
@if($usuario->rol_id == \App\enums\TipoRol::ADMINISTRADOR)
    @include('admin.nav-admin')
@elseif($usuario->rol_id == \App\enums\TipoRol::AYUDANTE)
    @include('ayudante.nav-ayudante')
@elseif($usuario->rol_id == \App\enums\TipoRol::AUDITOR)
    @include('auditor.nav-auditor')
@elseif($usuario->rol_id == \App\enums\TipoRol::ENCARGADO)
    @include('encargado.nav-encargado')
@endif

@include('utils.alerts')
<div>
    @include('admin.table-boletas')
</div>
@vite('resources/js/alerts.js')
</body>
</html>
