<h1 class="text-center text-4xl font-bold">Boletas {{ $title }}</h1>
<!-- component -->

<div class="container mx-auto p-4 font-mono">
    <div class="p-3">
        @if($usuario->rol_id == \App\enums\TipoRol::ADMINISTRADOR)
            <form class="flex flex-row" method="get"
                  action="{{ route('solicitud.boletas') }}"
            >
                @csrf
                <div class="sm:col-span-3">
                    <p class="text-xs text-gray-600">Filtar por estado</p>
                    <div class="mt-2 grid grid-cols-1">
                        <select id="estado" name="estado" autocomplete="genero-name" required
                                class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="">Seleccione una opción</option>
                            <option value="{{ \App\enums\TipoBoleta::SOLICITADO }}">Solicitadas</option>
                            <option value="{{ \App\enums\TipoBoleta::APROBADO }}">Aprobadas</option>
                            <option value="{{ \App\enums\TipoBoleta::RECHAZADO }}">Rechazadas</option>
                            <option value="{{ \App\enums\TipoBoleta::PAGADO }}">Pagadas</option>
                            <option value="{{ \App\enums\TipoBoleta::NO_PAGADO }}">No pagadas</option>
                        </select>
                        <br>
                        <svg
                            class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                            viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd"
                                  d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <button class="p-3 font-semibold text-semibold rounded-xlshadow-lg "
                        type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                    </svg>
                </button>
            </form>
        @endif
    </div>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-50 uppercase">
                    <th class="px-4 py-3">Correlativo</th>
                    <th class="px-4 py-3">Fecha solicitada</th>
                    <th class="px-4 py-3">Fecha aprobada</th>
                    <th class="px-4 py-3">Estado</th>
                    <th class="px-4 py-3">Contrato</th>
                    <th class="px-4 py-3">Accion</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                @foreach($boletas as $boleta)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 text-ms font-semibold">BO{{ $boleta->correlativo }}</td>
                        <td class="px-4 py-3 text-ms font-semibold">{{ $boleta->fecha_solicitado }}</td>
                        <td class="px-4 py-3 text-ms font-semibold">{{ ($boleta->fecha_aprobacion == '' | null) ? 'En espera de aprobación' : $boleta->fecha_aprobacion }}</td>
                        <td class="px-4 py-3 text-xs">
                            @if($usuario->rol_id == \App\enums\TipoRol::AUDITOR)
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-sm">
                                    Pendiente de pago
                                </span>
                            @else
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-sm">
                                    {{ $boleta->estado_boleta }}
                                </span>
                            @endif

                        </td>
                        <td class="px-4 py-3 text-sm flex">
                            <a href="{{ route('contrato.detalle', ['id' => $boleta->id_boleta ]) }}"
                               title="Contrato Asociado">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor"
                                     class="size-6 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z"/>
                                </svg>
                            </a>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex flex-row">
                                @if($usuario->rol_id == \App\enums\TipoRol::ENCARGADO)
                                    @if($boleta->estado_boleta == \App\enums\TipoBoleta::APROBADO)
                                        <a href="{{ route('descargar.boleta', ['id' => $boleta->correlativo]) }}"
                                           title="Descargar boleta"
                                           class="shadow-md font-bold p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor"
                                                 class="size-6 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m-6 3.75 3 3m0 0 3-3m-3 3V1.5m6 9h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('subir.comprobante', ['correlativo' => $boleta->correlativo]) }}"
                                           title="Subir comprobante"
                                           class="shadow-md font-bold p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor"
                                                 class="size-6 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75"/>
                                            </svg>
                                        </a>
                                    @endif
                                @elseif($usuario->rol_id == \App\enums\TipoRol::ADMINISTRADOR)
                                    @if($boleta->estado_boleta == \App\enums\TipoBoleta::SOLICITADO
                                        || $boleta->estado_boleta == \App\enums\TipoBoleta::RECHAZADO)
                                        <a onclick="return confirm('¿Desea aprobar la solicitud de boleta?')"
                                           title="Aprobar solicitud"
                                           class="p-2"
                                           href="{{ route('actualizar.boleta',['id' => $boleta->correlativo, 'estado' => \App\enums\TipoBoleta::APROBADO] ) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z"/>
                                            </svg>
                                        </a>
                                        <a onclick="return confirm('¿Desea rechazar la solicitud de boleta?');"
                                           title="Rechazar solicitud"
                                           class="p-2"
                                           href="{{ route('actualizar.boleta',['id' => $boleta->correlativo, 'estado' => \App\enums\TipoBoleta::RECHAZADO] ) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor"
                                                 class="size-6 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54"/>
                                            </svg>
                                        </a>
                                    @elseif ($boleta->archivo != \App\enums\Utiles::DEFAULT_VALUE_ARCHIVO)
                                        <a href="{{ $boleta->archivo }}"
                                           target="_blank"
                                           title="Ver comprobante">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor"
                                                 class="size-6 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                                            </svg>
                                        </a>
                                        @if($boleta->estado_boleta == \App\enums\TipoBoleta::NO_PAGADO
                                            || $boleta->estado_boleta == \App\enums\TipoBoleta::APROBADO)
                                            <a href="{{ route('actualizar.boleta', ['id' => $boleta->correlativo, 'estado' => \App\enums\TipoBoleta::PAGADO]) }}"
                                               onclick="return confirm('¿Desea marcar como pagada?')"
                                               title="Marcar como pagada">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor"
                                                     class="size-6 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('actualizar.boleta', ['id' => $boleta->correlativo, 'estado' => \App\enums\TipoBoleta::NO_PAGADO]) }}"
                                               onclick="return confirm('¿Desea marcar como no pagada?')"
                                               title="Marcar como no pagada">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor"
                                                     class="size-6 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54"/>
                                                </svg>
                                            </a>
                                        @endif
                                    @endif
                                @elseif($usuario->rol_id == \App\enums\TipoRol::AYUDANTE)
                                    @if($boleta->estado_boleta == \App\enums\TipoBoleta::SOLICITADO
                                        || $boleta->estado_boleta == \App\enums\TipoBoleta::RECHAZADO)
                                        <a onclick="return confirm('¿Desea aprobar la solicitud de boleta?')"
                                           title="Aprobar solicitud"
                                           class="p-2"
                                           href="{{ route('actualizar.boleta',['id' => $boleta->correlativo, 'estado' => \App\enums\TipoBoleta::APROBADO] ) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z"/>
                                            </svg>
                                        </a>
                                        <a onclick="return confirm('¿Desea rechazar la solicitud de boleta?');"
                                           title="Rechazar solicitud"
                                           class="p-2"
                                           href="{{ route('actualizar.boleta',['id' => $boleta->correlativo, 'estado' => \App\enums\TipoBoleta::RECHAZADO] ) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor"
                                                 class="size-6 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54"/>
                                            </svg>
                                        </a>
                                    @endif
                                @endif
                                <a href="{{ route('detalle.boleta', ['correlativo' => $boleta->correlativo ]) }}"
                                   title="Ver boleta">
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
