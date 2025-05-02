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
@endphp
@if($usuario->rol_id == \App\enums\TipoRol::AYUDANTE)
    @include('ayudante.nav-ayudante')
@endif
@include('utils.alerts')


<!-- component -->
<div class="container mx-auto p-4 font-mono">
    <div class="mb-3">
        <a class="p-3 font-semibold text-semibold rounded-xlshadow-lg flex flex-row"
           href="javascript:history.back()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-6 mx-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"/>
            </svg>
            Regresar
        </a>
    </div>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-50 uppercase">
                    <th class="px-4 py-3" colspan="4"><h2 class="text-center text-2xl">Contrato
                            No. {{ $contrato->id_contrato }}</h2></th>
                </tr>
                </thead>
                <tbody class="bg-white">
                <tr>
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Fecha inicio:
                                </p>
                                <p class="text-xs text-gray-900"> {{ $contrato->fecha_inicio }} </p>
                            </div>
                        </div>
                    </td>

                    <td class="px-4 py-3">
                        <div class="items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Fecha finalización:
                                </p>
                                <p class="text-xs text-gray-900">{{ $contrato->fecha_finalizacion }} </p>
                            </div>
                        </div>
                    </td>

                    <td class="px-4 py-3">
                        <div class="items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Fecha limite de renovación:
                                </p>
                                <p class="text-xs text-gray-900">{{ $contrato->fecha_limite }} </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-xs">
                        <div class="items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Estado:
                                </p>
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">
                                    {{ $contrato->estado }}</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-50 uppercase">
                    <td class="px-4 py-3" colspan="4">
                        <p class="font-semibold text-black text-center">
                            Nicho
                        </p>
                    </td>
                </tr>
                <tr class="text-gray-700">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    CODIGO
                                </p>
                                <p class="text-xs text-gray-900"> NI-{{ $nicho->codigo }} </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3" colspan="4">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Ubicacion
                                </p>
                                <p class="text-xs text-gray-900">
                                    <strong>Calle:</strong> {{ $nicho->calle->numero_calle }}
                                    ({{ $nicho->calle->nombre_calle }})
                                    <strong>Avenida:</strong> {{ $nicho->avenida->numero_calle }}
                                    ({{ $nicho->avenida->nombre_calle }}) </p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-50 uppercase">
                    <td class="px-4 py-3" colspan="4">
                        <p class="font-semibold text-black text-center">
                            Informacion del Ocupante
                        </p>
                    </td>
                </tr>
                <tr class="text-gray-700">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    DPI
                                </p>
                                <p class="text-xs text-gray-900"> {{ $ocupante->persona->dpi }} </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Genero
                                </p>
                                @if($ocupante->persona->genero == 'M')
                                    <p class="text-xs text-gray-900">Masculino</p>
                                @else
                                    <p class="text-xs text-gray-900">Femenino</p>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Nombre completo
                                </p>
                                <p class="text-xs text-gray-900">
                                    {{ $ocupante->persona->nombre1 }} {{ $ocupante->persona->nombre2 }} {{ $ocupante->persona->apellido1 }} {{ $ocupante->persona->apellido2 }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Procedencia
                                </p>
                                <p class="text-xs text-gray-900">
                                    {{ $ocupante->procedencia }}, {{ $ocupante->municipio->nombre_municipio }},
                                    {{ $ocupante->municipio->departamento->nombre_departamento }}
                                </p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="text-gray-700">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Fecha de nacimiento
                                </p>
                                <p class="text-xs text-gray-900"> {{ $ocupante->fecha_nacimiento }} </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Fecha fallecimiento
                                </p>
                                <p class="text-xs text-gray-900">
                                    {{ $ocupante->fecha_fallecimiento }}</p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-50 uppercase">
                    <td class="px-4 py-3" colspan="4">
                        <p class="font-semibold text-black text-center">
                            Informacion del Encargado
                        </p>
                    </td>
                </tr>
                <tr class="text-gray-700">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    DPI
                                </p>
                                <p class="text-xs text-gray-900"> {{ $encargado->persona->dpi }} </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Genero
                                </p>
                                @if($encargado->persona->genero == 'M')
                                    <p class="text-xs text-gray-900">Masculino</p>
                                @else
                                    <p class="text-xs text-gray-900">Femenino</p>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Nombre completo
                                </p>
                                <p class="text-xs text-gray-900">
                                    {{ $encargado->persona->nombre1 }} {{ $encargado->persona->nombre2 }} {{ $encargado->persona->apellido1 }} {{ $encargado->persona->apellido2 }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Dirección
                                </p>
                                <p class="text-xs text-gray-900">
                                    {{ $encargado->direccion }}</p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="text-gray-700">
                    <td class="px-4 py-3" colspan="4">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Contacto
                                </p>
                                <p class="text-xs text-gray-900"><strong>Telefono:</strong> {{ $encargado->telefono }}
                                    <strong>Correo:</strong> {{ $encargado->correo }} </p>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <form action="{{ route('enviar.contrato') }}"
                  class="m-6"
                  method="post">
                @csrf
                <input type="hidden" value="{{ $ocupante->id_ocupante }}" name="ocupante">
                <input type="hidden" value="{{ $encargado->id_encargado }}" name="encargado">
                <input type="hidden" value="{{ $nicho->codigo }}" name="nicho">
                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 rounded-xl hover:bg-indigo-500 transition duration-200">
                    Confirmar
                </button>
            </form>
        </div>
    </div>
</div>


@vite('resources/js/alerts.js')
@yield('content')
</body>
</html>

