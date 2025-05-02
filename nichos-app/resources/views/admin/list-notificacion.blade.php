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
@elseif($usuario->rol_id == \App\enums\TipoRol::AUDITOR)
    @include('auditor.nav-auditor')
@elseif($usuario->rol_id == \App\enums\TipoRol::ENCARGADO)
    @include('encargado.nav-encargado')
@endif
@include('utils.alerts')
<div>

    <!-- component -->
    <div class="max-w-screen-xl mx-auto px-5 bg-white min-h-sceen">
        <div class="flex flex-col items-center">
            <h2 class="font-bold text-5xl mt-5 tracking-tight">
                Notificaciones
            </h2>
            <p class="text-neutral-500 text-xl mt-3">

            </p>
        </div>
        <div class="grid divide-y divide-neutral-200 max-w-xl mx-auto mt-8 shadow-md rounded-xl p-6">
            @foreach($leidos as $l)
                @php
                    $aux = explode(" ", $l->descripcion);

                @endphp
                <div class="py-5">
                    <details class="group">
                        <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                            <span>{{ $aux[0] }} {{ $aux[1] }} {{ $aux[2] }} {{ $aux[3] }} ...</span>
                            <span class="transition group-open:rotate-180">
                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor"
                     stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path
                        d="M6 9l6 6 6-6"></path>
                </svg>
              </span>
                        </summary>
                        <p class="text-neutral-600 mt-3 group-open:animate-fadeIn">
                            {{ $l->fecha }} {{ $l->descripcion }}
                        </p>
                    </details>
                </div>
            @endforeach

        </div>
    </div>

    <script>
        // ...
        // extend: {
        //   keyframes: {
        //     fadeIn: {
        //       "0%": { opacity: 0 },
        //       "100%": { opacity: 100 },
        //     },
        //   },
        //   animation: {
        //     fadeIn: "fadeIn 0.2s ease-in-out forwards",
        //   },
        // },
        // ...
    </script>
</div>
@vite('resources/js/alerts.js')
</body>
</html>

