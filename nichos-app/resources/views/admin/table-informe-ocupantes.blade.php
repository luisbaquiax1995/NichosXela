<h1 class="text-center text-3xl font-bold">Distribución de ocupantes</h1>
<!-- component -->
<div class="container mx-auto p-4 font-mono">
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">

            <div class="relative pt-32 pb-32 bg-lightBlue-500">
                <div class="px-4 md:px-6 mx-auto w-full">
                    <div>
                        <div class="grid grid-cols-1">
                            <div class="flex flex-wrap">

                                <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                                        <div class="flex-auto p-4">
                                            <div class="flex flex-wrap">
                                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">Total</h5>
                                                    <span class="font-bold text-xl">
                                                    {{ $porGenero[0]->cantidad + $porGenero[1]->cantidad }}
                                                </span>
                                                    <span class="text-blueGray-400 uppercase text-xs">
                                                    <div class="grid grid-cols-1">
                                                        <div>
                                                            Hombres: {{ $porGenero[0]->cantidad }}
                                                        </div>
                                                        <div>
                                                            Mujeres: {{ $porGenero[1]->cantidad }}
                                                        </div>
                                                    </div>
                                                </span>
                                                </div>
                                                <div class="relative w-auto pl-4 flex-initial">
                                                    <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-black">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                             class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-sm text-blueGray-500 mt-4">
                                            <span class="whitespace-nowrap">
                                                Total de ocupantes
                                            </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                                        <div class="flex-auto p-4">
                                            <div class="flex flex-wrap">
                                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">Total</h5>
                                                    <span class="font-bold text-xl">{{ ($niños != null) ? $niños[0]->cantidad + $niños[1]->cantidad : 0 }}</span>
                                                    <span class="text-blueGray-400 uppercase text-xs">
                                                    <div class="grid grid-cols-1">
                                                        <div>
                                                            Niños: {{ ($niños != null) ? $niños[0]->cantidad : 0 }}
                                                        </div>
                                                        <div>
                                                            Niñas: {{ ($niños != null) ? $niños[1]->cantidad : 0 }}
                                                        </div>
                                                    </div>
                                                </span>
                                                </div>
                                                <div class="relative w-auto pl-4 flex-initial">
                                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-cyan-500">
                                                        <img src="{{ asset('img/children.svg') }}" alt="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-sm text-blueGray-500 mt-4">
                                            <span class="text-red-500 mr-2">
                                                <i class="fas fa-arrow-down"></i>
                                            </span>
                                                <span class="whitespace-nowrap">Niños y niñas (0-10 años)</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                                    <div
                                        class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                                        <div class="flex-auto p-4">
                                            <div class="flex flex-wrap">
                                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">Total</h5>
                                                    <span class="font-bold text-xl">
                                                    {{ ($jovenes != null) ? $jovenes[0]->cantidad + $jovenes[1]->cantidad : 0 }}
                                                </span>
                                                    <span class="text-blueGray-400 uppercase text-xs">
                                                    <div class="grid grid-cols-1">
                                                        <div>
                                                            Jóvenes: {{ ($jovenes != null) ? $jovenes[0]->cantidad : 0 }}
                                                        </div>
                                                        <div>
                                                            Señoritas: {{ ($jovenes != null) ? $jovenes[1]->cantidad : 0 }}
                                                        </div>
                                                    </div>
                                                </span>
                                                </div>
                                                <div class="relative w-auto pl-4 flex-initial">
                                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500">
                                                        <img src="{{ asset('img/boy.svg') }}" alt="2">
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-sm text-blueGray-500 mt-4">
                                                <span class="whitespace-nowrap">Jóvenes y señoritas (11-18 años)</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                                    <div
                                        class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                                        <div class="flex-auto p-4">
                                            <div class="flex flex-wrap">
                                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                                                        Total</h5>
                                                    <span class="font-bold text-xl">
                                                </span>
                                                    <span class="text-blueGray-400 uppercase text-xs">
                                                    <div class="grid grid-cols-1">
                                                        <div>
                                                            Hombres: {{ ($adultos[0] != null) ? $adultos[0]->cantidad : 0 }}
                                                        </div>
                                                        <div>
                                                            Mujeres: {{ ($adultos != null) ? $adultos[1]->cantidad : 0 }}
                                                        </div>
                                                    </div>
                                                </span>
                                                </div>
                                                <div class="relative w-auto pl-4 flex-initial">
                                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-yellow-500">
                                                        <img src="{{ asset('img/man.svg') }}" alt="3">
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-sm text-blueGray-500 mt-4">
                                                <span class="whitespace-nowrap">Adultos (18-30 años)</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="flex flex-wrap mt-6 flex justify-center">

                                <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                                        <div class="flex-auto p-4">
                                            <div class="flex flex-wrap">
                                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">Total</h5>
                                                    <span class="font-bold text-xl">
                                                    {{ $abuelos[0]->cantidad + $abuelos[1]->cantidad }}
                                                </span>
                                                    <span class="text-blueGray-400 uppercase text-xs">
                                                    <div class="grid grid-cols-1">
                                                        <div>
                                                            Hombres: {{ $abuelos[0]->cantidad }}
                                                        </div>
                                                        <div>
                                                            Mujeres: {{ $abuelos[1]->cantidad }}
                                                        </div>
                                                    </div>
                                                </span>
                                                </div>
                                                <div class="relative w-auto pl-4 flex-initial">
                                                    <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-black">
                                                        <img src="{{ asset('img/abuelo.png') }}" alt="4">
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-sm text-blueGray-500 mt-4">
                                            <span class="whitespace-nowrap">
                                                Total de ocupantes
                                            </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

