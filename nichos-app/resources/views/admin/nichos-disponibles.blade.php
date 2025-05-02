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
    $calles = \App\Http\Controllers\CalleController::getCalles(\App\Models\Calle::CALLE);
    $avenidas = \App\Http\Controllers\CalleController::getCalles(\App\Models\Calle::AVENIDA);
@endphp
@if($usuario->rol_id == \App\enums\TipoRol::ADMINISTRADOR)
    @include('admin.nav-admin')
@elseif($usuario->rol_id == \App\enums\TipoRol::AYUDANTE)
    @include('ayudante.nav-ayudante')
@elseif($usuario->rol_id == \App\enums\TipoRol::ENCARGADO)
    @include('encargado.nav-encargado')
@endif
@include('utils.alerts')
<h1 class="text-center text-4xl font-bold">
    Nichos {{ $titulo_nicho }}</h1>
<!-- component -->
<div class="container mx-auto p-4 font-mono">
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">

        @if($usuario->rol_id == \App\enums\TipoRol::ENCARGADO)
            <div class="flex flex-row gap-3 items-start p-2">
                <form class="flex flex-row items-end gap-2"
                      method="get"
                      action="{{ route('nicho.porCodigo') }}">
                    @csrf
                    <input type="hidden" value="{{ \App\enums\EstadoNicho::DISPONIBLE }}" name="estado">
                    <div class="sm:col-span-3">
                        <p class="text-xs text-gray-600">Filtar por código</p>
                        <div class="mt-2 grid grid-cols-1">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <p class="font-semibold">NI-</p>
                                </div>
                                <input type="number" id="simple-search" name="codigo"
                                       class="bg-gra border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2  dark:bg-gr dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 font-bold dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Igrese código..." required />
                            </div>
                        </div>
                    </div>
                    <button class="p-2 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-105" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                        </svg>
                    </button>
                </form>

                <form class="flex flex-row items-end gap-2"
                      method="get"
                      action="{{ route('nicho.porCalle') }}">
                    @csrf
                    <input type="hidden" value="{{ \App\enums\EstadoNicho::DISPONIBLE }}" name="estado">
                    <div class="sm:col-span-3">
                        <p class="text-xs text-gray-600">Filtar por calle</p>
                        <div class="mt-2 grid grid-cols-1">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <select id="calle" name="calle" required
                                        class="bg-gra border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2  dark:bg-gr dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 font-bold dark:focus:ring-gray-500 dark:focus:border-gray-500">
                                    @foreach($calles as $calle)
                                        <option value="{{ $calle->id_calle }}">{{ $calle->numero_calle }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="p-2 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-105" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                        </svg>
                    </button>
                </form>

                <form class="flex flex-row items-end gap-2"
                      method="get"
                      action="{{ route('nicho.porCalle') }}">
                    @csrf
                    <input type="hidden" value="{{ \App\enums\EstadoNicho::DISPONIBLE }}" name="estado">
                    <div class="sm:col-span-3">
                        <p class="text-xs text-gray-600">Filtar por avenida</p>
                        <div class="mt-2 grid grid-cols-1">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <select id="avenida" name="avenida" required
                                        class="bg-gra border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2  dark:bg-gr dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 font-bold dark:focus:ring-gray-500 dark:focus:border-gray-500">
                                    @foreach($avenidas as $calle)
                                        <option value="{{ $calle->id_calle }}">{{ $calle->numero_calle }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="p-2 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-105" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                        </svg>
                    </button>
                </form>

            </div>
        @endif

        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-50 uppercase">
                    <th class="px-4 py-3">Codigo</th>
                    <th class="px-4 py-3">Ubicacion</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Estado</th>
                    <th class="px-4 py-3">Accion</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                @foreach($nichos as $nicho)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold text-black">
                                        NI-{{ $nicho->codigo }}
                                    </p>
                                    <p class="text-xs text-gray-600"></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-ms">
                            <strong>{{ $nicho->numero1 }} Calle:</strong> {{ $nicho->calle }}
                            <br><strong>{{ $nicho->numero2 }} Avenida:</strong> {{ $nicho->avenida }}
                        </td>
                        <td class="px-4 py-3 text-xs">
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-sm">
                                    {{ $nicho->status }}
                                </span>
                        </td>
                        <td class="px-4 py-3 text-xs">
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">
                                    {{ $nicho->estado_nicho }}
                                </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex flex-row">
                                @if($usuario->rol_id == \App\enums\TipoRol::ADMINISTRADOR)
                                    <a href="{{ route('editar.nicho', ['id' => $nicho->codigo]) }}"
                                       title="Editar nicho"
                                       class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="size-6 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                        </svg>
                                    </a>
                                    <a href=""
                                       title="Agregar foto"
                                       class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="size-6 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                    </a>
                                @elseif($usuario->rol_id == \App\enums\TipoRol::ENCARGADO)

                                @endif
                                <a href="{{ route('foto.nicho', ['id' => $nicho->codigo]) }}" title="Ver nicho" class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor"
                                         class="size-6 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@vite('resources/js/alerts.js')
</body>
</html>
