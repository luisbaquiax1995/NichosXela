
<!-- component -->
<div class="container mx-auto p-4 font-mono">
    <div class="mb-3">
        <a class="p-3 font-semibold text-semibold rounded-xlshadow-lg flex flex-row"
           href="javascript:history.back()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mx-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
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
                                <p class="text-xs text-gray-900"> NI-{{ $contrato->codigo }} </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3" colspan="4">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Ubicacion
                                </p>
                                <p class="text-xs text-gray-900"><strong>Calle:</strong> {{ $contrato->ncalle }} ({{ $contrato->calle }})
                                    <strong>Avenida:</strong> {{ $contrato->navenida }} ({{ $contrato->avenida }}) </p>
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
                                <p class="text-xs text-gray-900"> {{ $contrato->odpi }} </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Genero
                                </p>
                                @if($contrato->ogenero == 'M')
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
                                    {{ $contrato->onombre1 }} {{ $contrato->onombre2 }} {{ $contrato->oapellido1 }} {{ $contrato->oapellido2 }}</p>
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
                                    {{ $contrato->procedencia }}, {{ $contrato->nombre_municipio }}
                                    , {{ $contrato->nombre_departamento }} </p>
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
                                <p class="text-xs text-gray-900"> {{ $contrato->fecha_nacimiento }} </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Nombre fallecimiento
                                </p>
                                <p class="text-xs text-gray-900">
                                    {{ $contrato->fecha_fallecimiento }}</p>
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
                                <p class="text-xs text-gray-900"> {{ $contrato->odpi }} </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Genero
                                </p>
                                @if($contrato->ogenero == 'M')
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
                                    {{ $contrato->nombre1 }} {{ $contrato->nombre2 }} {{ $contrato->apellido1 }} {{ $contrato->apellido2 }}</p>
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
                                    {{ $contrato->direccion }}</p>
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
                                <p class="text-xs text-gray-900"><strong>Telefono:</strong> {{ $contrato->telefono }}
                                    <strong>Correo:</strong> {{ $contrato->correo }} </p>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
