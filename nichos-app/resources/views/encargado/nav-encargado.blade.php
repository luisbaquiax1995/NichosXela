<nav x-data="{ mobileMenuOpen: false, productMenuOpen: false, mobileProductMenuOpen: false }"
     class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
    <!-- Logo -->
    <div class="flex lg:flex-1">
        <a href="/home-encargado" class="-m-1.5 p-1.5">
            <span class="sr-only">Nichos Xela</span>
            <img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                 alt="">
        </a>
    </div>

    <!-- Botón menú móvil -->
    <div class="flex lg:hidden">
        <button @click="mobileMenuOpen = true" type="button"
                class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Open main menu</span>
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 7.5h16.5m-16.5 7.5h16.5"/>
            </svg>
        </button>
    </div>

    <!-- Navegación desktop -->
    <div class="hidden lg:flex lg:gap-x-12">
        <!-- Dropdown nichos -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" @click.away="open = false" type="button"
                    class="flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900">
                Nichos
                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.061l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                          clip-rule="evenodd"/>
                </svg>
            </button>

            <div
                class="absolute top-full -left-8 z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5"
                x-show="open"
                @click.outside="open = false"
            >
                <div class="p-4">

                    <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                        <div
                            class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                            <img src="{{ asset('img/nichos.svg') }}" alt="nichos" class="size-6">
                        </div>
                        <div class="flex-auto">
                            <a href="{{ route('nicho.nichos', ['estado' => \App\enums\EstadoNicho::DISPONIBLE]) }}"
                               class="block font-semibold text-gray-900">
                                Nichos disponibles
                                <span class="absolute inset-0"></span>
                            </a>
                            <p class="mt-1 text-gray-600">Ver nichos disponibles</p>
                        </div>
                    </div>

                    <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                        <div
                            class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                            <img src="{{ asset('img/nichos2.svg') }}" alt="nichos" class="size-6">
                        </div>
                        <div class="flex-auto">
                            <a href="{{ route('nicho.nichos', ['estado' => \App\enums\EstadoNicho::OCUPADO]) }}"
                               class="block font-semibold text-gray-900">
                                Nichos ocupados
                                <span class="absolute inset-0"></span>
                            </a>
                            <p class="mt-1 text-gray-600">Ver nichos ocupados</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dropdown boleta -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" @click.away="open = false" type="button"
                    class="flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900">
                Boleta
                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.061l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                          clip-rule="evenodd"/>
                </svg>
            </button>

            <div
                class="absolute top-full -left-8 z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5"
                x-show="open"
                @click.outside="open = false"
            >
                <div class="p-4">
                    <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                        <div
                            class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/>
                            </svg>
                        </div>
                        <div class="flex-auto">
                            <form action="{{ route('boleta.encargado') }}" method="get">
                                @csrf
                                <input type="hidden" value="{{ \App\enums\TipoBoleta::SOLICITADO }}" name="estado">
                                <button type="submit" class="block font-semibold text-gray-900">
                                    Boletas solicitadas
                                    <span class="absolute inset-0"></span>
                                </button>
                            </form>

                            <p class="mt-1 text-gray-600">Revisa las boletas solicitadas</p>
                        </div>
                    </div>
                    <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                        <div
                            class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                            </svg>
                        </div>
                        <div class="flex-auto">
                            <form action="{{ route('boleta.encargado') }}" method="get">
                                @csrf
                                <input type="hidden" value="{{ \App\enums\TipoBoleta::APROBADO }}" name="estado">
                                <button type="submit" class="block font-semibold text-gray-900">
                                    Boletas aprobadas
                                    <span class="absolute inset-0"></span>
                                </button>
                            </form>

                            <p class="mt-1 text-gray-600">Revisa las boletas aprobadas</p>
                        </div>
                    </div>
                    <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                        <div
                            class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54"/>
                            </svg>
                        </div>
                        <div class="flex-auto">
                            <form action="{{ route('boleta.encargado') }}" method="get">
                                @csrf
                                <input type="hidden" value="{{ \App\enums\TipoBoleta::RECHAZADO }}" name="estado">
                                <button type="submit" class="block font-semibold text-gray-900">
                                    Boletas rechazadas
                                    <span class="absolute inset-0"></span>
                                </button>
                            </form>

                            <p class="mt-1 text-gray-600">Revisa las boletas rechazadas</p>
                        </div>
                    </div>
                    <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                        <div
                            class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/>
                            </svg>
                        </div>
                        <div class="flex-auto">
                            <form action="{{ route('boleta.encargado') }}" method="get">
                                @csrf
                                <input type="hidden" value="{{ \App\enums\TipoBoleta::PAGADO }}" name="estado">
                                <button type="submit" class="block font-semibold text-gray-900">
                                    Boletas pagadas
                                    <span class="absolute inset-0"></span>
                                </button>
                            </form>

                            <p class="mt-1 text-gray-600">Revisa las boletas pagadas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dropdown contratos -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" @click.away="open = false" type="button"
                    class="flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900">
                Contratos
                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.061l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                          clip-rule="evenodd"/>
                </svg>
            </button>

            <div
                class="absolute top-full -left-8 z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5"
                x-show="open"
                @click.outside="open = false"
            >
                <div class="p-4">
                    <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                        <div
                            class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                            </svg>
                        </div>
                        <div class="flex-auto">
                            <form action="{{ route('contratos.getByEstado1') }}" method="get">
                                @csrf
                                <input type="hidden" value="{{ \App\enums\TipoContrato::ACTIVO }}" name="estado">
                                <button type="submit" class="block font-semibold text-gray-900">
                                    Revisión de contratos
                                    <span class="absolute inset-0"></span>
                                </button>
                            </form>
                            <p class="mt-1 text-gray-600">Revisa los contratos activos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dropdown Exhumaciones -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" @click.away="open = false" type="button"
                    class="flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900">
                Exhumaciones
                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.061l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                          clip-rule="evenodd"/>
                </svg>
            </button>

            <div
                class="absolute top-full -left-8 z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5"
                x-show="open"
                @click.outside="open = false"
            >
                <div class="p-4">
                    <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                        <div
                            class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                            </svg>
                        </div>
                        <div class="flex-auto">
                            <a href="/form-solicitud-exhumacion" type="submit"
                               class="block font-semibold text-gray-900">
                                Solicictar exhumacion
                                <span class="absolute inset-0"></span>
                            </a>
                            <p class="mt-1 text-gray-600">Evía una solicitud de exhumacion</p>
                        </div>
                    </div>
                    <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                        <div
                            class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75"/>
                            </svg>
                        </div>
                        <div class="flex-auto">
                            <form
                                action="{{ route('exhumacion.solicitudesEncargado') }}"
                                method="get">
                                @csrf
                                <input type="hidden" value="{{ \App\enums\EstadoExhumacion::SOLICITADO }}"
                                       name="estado">
                                <button type="submit"
                                        class="block font-semibold text-gray-900">
                                    Solicitudes
                                    <span class="absolute inset-0"></span>
                                </button>
                            </form>
                            <p class="mt-1 text-gray-600">Revisa las solicitudes enviadas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Notificcion -->
        <div x-data="{ open: false }" class="relative">
            <a href="{{ route('ver.notificaciones') }}"
               class="flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5"/>
                </svg>
            </a>
        </div>
    </div>

    <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <!-- Profile dropdown -->
        <div class="relative ml-3">
            <div>
                <button type="button"
                        class="p-1 relative flex max-w-xs items-center rounded-full text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden"
                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">Perfil de usuario</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                    </svg>
                    {{ session('usuario')->username }}
                </button>
            </div>

            <div id="user-dropdown"
                 class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-hidden"
                 role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <a class="block px-4 py-2 text-sm text-sm text-gray-900">{{ session('usuario')->username }}</a>
                <a href="{{ route('user.logout') }}"
                   class="block px-4 py-2 text-sm text-sm font-semibold text-gray-900">Salir <span aria-hidden="true">&rarr;</span></a>
            </div>
        </div>
    </div>

    <!-- Menú móvil -->
    <div x-show="mobileMenuOpen" x-transition class="lg:hidden fixed inset-0 z-50 bg-white px-6 py-6 overflow-y-auto">
        <div class="flex items-center justify-between">
            <a href="#" class="-m-1.5 p-1.5">
                <span class="sr-only">Your Company</span>
                <img class="h-8 w-auto"
                     src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="">
            </a>
            <button @click="mobileMenuOpen = false" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                <span class="sr-only">Close menu</span>
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="mt-6 flow-root">
            <div class="-my-6 divide-y divide-gray-500/10">
                <div class="space-y-2 py-6">
                    <!-- Dropdown móvil -->
                    <div>
                        <button @click="mobileProductMenuOpen = !mobileProductMenuOpen"
                                type="button"
                                class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">
                            Product
                            <svg :class="{ 'rotate-180': mobileProductMenuOpen }"
                                 class="h-5 w-5 transition-transform" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="mobileProductMenuOpen" x-transition class="mt-2 space-y-2 pl-4">
                            <div class="p-4">
                                <div
                                    class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                                    <div
                                        class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                        <svg class="size-6 text-gray-600 group-hover:text-indigo-600" fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                             aria-hidden="true"
                                             data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-auto">
                                        <a href="#" class="block font-semibold text-gray-900">
                                            Analytics
                                            <span class="absolute inset-0"></span>
                                        </a>
                                        <p class="mt-1 text-gray-600">Get a better understanding of your traffic</p>
                                    </div>
                                </div>
                                <div
                                    class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                                    <div
                                        class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                        <svg class="size-6 text-gray-600 group-hover:text-indigo-600" fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                             aria-hidden="true"
                                             data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59"/>
                                        </svg>
                                    </div>
                                    <div class="flex-auto">
                                        <a href="#" class="block font-semibold text-gray-900">
                                            Engagement
                                            <span class="absolute inset-0"></span>
                                        </a>
                                        <p class="mt-1 text-gray-600">Speak directly to your customers</p>
                                    </div>
                                </div>
                                <div
                                    class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                                    <div
                                        class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                        <svg class="size-6 text-gray-600 group-hover:text-indigo-600" fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                             aria-hidden="true"
                                             data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M7.864 4.243A7.5 7.5 0 0 1 19.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 0 0 4.5 10.5a7.464 7.464 0 0 1-1.15 3.993m1.989 3.559A11.209 11.209 0 0 0 8.25 10.5a3.75 3.75 0 1 1 7.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 0 1-3.6 9.75m6.633-4.596a18.666 18.666 0 0 1-2.485 5.33"/>
                                        </svg>
                                    </div>
                                    <div class="flex-auto">
                                        <a href="#" class="block font-semibold text-gray-900">
                                            Security
                                            <span class="absolute inset-0"></span>
                                        </a>
                                        <p class="mt-1 text-gray-600">Your customers’ data will be safe and secure</p>
                                    </div>
                                </div>
                                <div
                                    class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                                    <div
                                        class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                        <svg class="size-6 text-gray-600 group-hover:text-indigo-600" fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                             aria-hidden="true"
                                             data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-auto">
                                        <a href="#" class="block font-semibold text-gray-900">
                                            Integrations
                                            <span class="absolute inset-0"></span>
                                        </a>
                                        <p class="mt-1 text-gray-600">Connect with third-party tools</p>
                                    </div>
                                </div>
                                <div
                                    class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                                    <div
                                        class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                        <svg class="size-6 text-gray-600 group-hover:text-indigo-600" fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                             aria-hidden="true"
                                             data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                                        </svg>
                                    </div>
                                    <div class="flex-auto">
                                        <a href="#" class="block font-semibold text-gray-900">
                                            Automations
                                            <span class="absolute inset-0"></span>
                                        </a>
                                        <p class="mt-1 text-gray-600">Build strategic funnels that will convert</p>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 divide-x divide-gray-900/5 bg-gray-50">
                                <a href="#"
                                   class="flex items-center justify-center gap-x-2.5 p-3 text-sm/6 font-semibold text-gray-900 hover:bg-gray-100">
                                    <svg class="size-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                         aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                              d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm6.39-2.908a.75.75 0 0 1 .766.027l3.5 2.25a.75.75 0 0 1 0 1.262l-3.5 2.25A.75.75 0 0 1 8 12.25v-4.5a.75.75 0 0 1 .39-.658Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    Watch demo
                                </a>
                                <a href="#"
                                   class="flex items-center justify-center gap-x-2.5 p-3 text-sm/6 font-semibold text-gray-900 hover:bg-gray-100">
                                    <svg class="size-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                         aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                              d="M2 3.5A1.5 1.5 0 0 1 3.5 2h1.148a1.5 1.5 0 0 1 1.465 1.175l.716 3.223a1.5 1.5 0 0 1-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 0 0 6.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 0 1 1.767-1.052l3.223.716A1.5 1.5 0 0 1 18 15.352V16.5a1.5 1.5 0 0 1-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 0 1 2.43 8.326 13.019 13.019 0 0 1 2 5V3.5Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    Contact sales
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Salir -->
                <div class="py-6">
                    <a href="{{ route('user.logout') }}"
                       class="block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Salir</a>
                </div>
            </div>
        </div>
    </div>
</nav>
@include('utils.js-footer')

