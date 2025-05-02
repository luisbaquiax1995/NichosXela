<h1 class="text-center text-4xl font-bold">Ocupantes</h1>
<!-- component -->
<div class="container mx-auto p-4 font-mono">
    <div>
        <a class="p-3 font-semibold text-semibold rounded-xl mb-6 shadow-lg"
           href="{{ route('user.ocupantes') }}">Registros activos</a>
        <a class="p-3 font-semibold text-semibold rounded-xl mb-6 shadow-lg"
           href="{{ route('ocupante.eliminados') }}">Registros eliminados</a>
    </div>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg mt-6">
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-50 uppercase">
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Lugar de procedencia</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Accion</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                @foreach($ocupantes as $user)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                </div>
                                <div>
                                    <p class="font-semibold text-black">
                                        {{ $user->nombre1  }} {{ $user->nombre2  }} {{ $user->apellido1  }} {{ $user->apellido2  }}
                                    </p>
                                    <p class="text-xs text-gray-600">Ocupante, DPI: {{ $user->dpi }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="text-black">
                                        {{ $user->procedencia  }}
                                    </p>
                                    <p class="text-xs text-gray-600">{{ $user->lugar }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-xs">
                            @if($user->tipo == 'PRIVILEGIADO')
                                <div class="flex flex-row justify-items-center">
                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                        </svg>
                                    </span>
                                </div>
                            @else
                                <span class="px-2 py-1 font-semibold leading-tight text-green-50-700 bg-green-100 rounded-sm">NORMAL</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex flex-row">
                                @if($user->tipo != \App\enums\TipoOcupante::PRIVILEGIADO)
                                    @if($user->estado == 1)
                                        <a href="{{ route('edit.ocupante', ['id' => $user->id_ocupante]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                 class="size-6 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </a>
                                        <a  onclick="return confirm('¿Desea eliminar al ocupante?')"
                                            href="{{ route('ocupante.delete', ['id' => $user->id_ocupante]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                 class="size-6 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

