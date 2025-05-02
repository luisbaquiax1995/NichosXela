<h1 class="text-center text-4xl font-bold uppercase">Contratos: {{ $titulo_contrato }}</h1>
<!-- component -->

<div class="container mx-auto p-4 font-mono">
    <div class="mb-3">
    </div>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-50 uppercase">
                    <th class="px-4 py-3">Nicho</th>
                    <th class="px-4 py-3">Ocupante</th>
                    <th class="px-4 py-3">Encargado</th>
                    <th class="px-4 py-3">Fecha finalización</th>
                    <th class="px-4 py-3">Estado</th>
                    <th class="px-4 py-3">Accion</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                @foreach($contratos as $contrato)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 text-gray-700">
                            NI-{{ $contrato->codigo }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                    </svg>
                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                </div>
                                <div>
                                    <p class="font-semibold text-black">
                                        {{ $contrato->onombre1  }} {{ $contrato->onombre2  }} {{ $contrato->oapellido1  }} {{ $contrato->oapellido2  }}
                                    </p>
                                    <p class="text-xs text-gray-600"></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                    </svg>
                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                </div>
                                <div>
                                    <p class="font-semibold text-black">
                                        {{ $contrato->nombre1  }} {{ $contrato->nombre2  }} {{ $contrato->apellido1  }} {{ $contrato->apellido2  }}
                                    </p>
                                    <p class="text-xs text-gray-600"></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold text-black">
                                        {{ $contrato->fecha_finalizacion }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-xs">
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"
                                >{{ $contrato->estado }}</span>

                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex flex-row">
                                <a href="{{ route('contrato.detalle', ['id' => $contrato->id_contrato]) }}" class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
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
