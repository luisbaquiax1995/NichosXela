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
                    <th class="px-4 py-3" colspan="4"><h2 class="text-center text-2xl">Boleta
                            BO-{{ $boleta->correlativo }}</h2></th>
                </tr>
                </thead>
                <tbody class="bg-white">
                <tr>
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Fecha de Solicitud:
                                </p>
                                <p class="text-xs text-gray-900"> {{ $boleta->fecha_solicitado }} </p>
                            </div>
                        </div>
                    </td>

                    <td class="px-4 py-3">
                        <div class="items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Fecha de Aprobación:
                                </p>
                                <p class="text-xs text-gray-900">{{ $boleta->fecha_aprobacion }} </p>
                            </div>
                        </div>
                    </td>

                    <td class="px-4 py-3">
                        <div class="items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Costo:
                                </p>
                                <p class="text-xs text-gray-900">{{ $boleta->costo }} </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-xs">
                        <div class="items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Estado de la Boleta:
                                </p>
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-{{ $boleta->estado_boleta === 'APROBADO' ? 'green' : ($boleta->estado_boleta === 'SOLICITADO' ? 'yellow' : ($boleta->estado_boleta === 'RECHAZADO' ? 'red' : ($boleta->estado_boleta === 'PAGADO' ? 'blue' : 'gray'))) }}-700 bg-{{ $boleta->estado_boleta === 'APROBADO' ? 'green' : ($boleta->estado_boleta === 'SOLICITADO' ? 'yellow' : ($boleta->estado_boleta === 'RECHAZADO' ? 'red' : ($boleta->estado_boleta === 'PAGADO' ? 'blue' : 'gray'))) }}-100 rounded-sm">
                                    {{ $boleta->estado_boleta }}
                                </span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-50 uppercase">
                    <td class="px-4 py-3" colspan="4">
                        <p class="font-semibold text-black text-center">
                            Información del Encargado
                        </p>
                    </td>
                </tr>
                <tr class="text-gray-700">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    DPI del Encargado
                                </p>
                                <p class="text-xs text-gray-900"> {{ $boleta->dpi }} </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    Nombre del Encargado
                                </p>
                                <p class="text-xs text-gray-900"> {{ $boleta->nombre }} </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3" colspan="2">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
