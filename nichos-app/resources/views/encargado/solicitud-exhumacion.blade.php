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
    $usuario = session('usuario');
    $ocupados = \App\Http\Controllers\NichoController::getNichosByEstado(\App\enums\EstadoNicho::OCUPADO);
    $motivos = \App\Http\Controllers\ExhumacionController::getMotivos();
@endphp
@if($usuario->rol_id == \App\enums\TipoRol::ENCARGADO)
    @include('encargado.nav-encargado')
@endif
@include('utils.alerts')
<div class="p-6 bg-white flex items-center justify-center">
    <form class="shadow-md p-6 rounded-xl"
          method="post"
          action="{{ route('solicitar.exhumacion') }}"
    >
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-3xl font-bold  text-gray-900 text-center">Solicitud de exhumacion</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-2">
                        <label for="nicho" class="block text-sm/6 font-medium text-gray-900">* Nicho ocupados</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="nicho" name="nicho" required
                                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                @foreach($ocupados as $o)
                                    <option value="{{ $o->codigo }}">NI-{{ $o->codigo }}</option>
                                @endforeach
                            </select>
                            <svg
                                class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                      d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="motivo" class="block text-sm/6 font-medium text-gray-900">* Motivo</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="motivo" name="motivo" required
                                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                @foreach($motivos as $o)
                                    <option value="{{ $o }}">{{ $o }}</option>
                                @endforeach
                            </select>
                            <svg
                                class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                      d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="otro" class="block text-sm/6 font-medium text-gray-900">Otro motivo</label>
                        <div class="mt-2 grid grid-cols-1">
                            <input type="text" name="otro" id="otro" autocomplete="family-name"
                                   placeholder="Ingrese el motivo..."
                                   class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-center gap-x-6">
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                        transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-100">
                Enviar solcitud
            </button>
        </div>
    </form>
</div>
@vite('resources/js/alerts.js')
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
