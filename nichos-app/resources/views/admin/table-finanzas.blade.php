<div class="shadow-md bg-white flex justify-center min-h-screen p-6">
    <div class="p-6">
        <p class="text-xl text-gray-950 py-2 px-2">Filtar por fecha</p>
        <form class="flex flex-row" method="get"
              action="{{ route('dinero.recaudadoFecha') }}"
        >
            @csrf
            <div class="sm:col-span-3 px-2">
                <div class="mt-2 grid grid-cols-1">
                    <input type="date" name="fecha1"
                        class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      <br>
                </div>
            </div>
            <div class="sm:col-span-3 px-2">
                <div class="mt-2 grid grid-cols-1">
                    <input type="date" name="fecha2"
                           class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                     <br>
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
        <div class="flex flex-row bg-white shadow-sm rounded p-4">
            <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-blue-100 text-blue-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="flex flex-col flex-grow ml-4">
                <div class="text-sm text-gray-500">Dinero recaudado</div>
                <div class="font-bold text-lg">Q. {{ $recaudado }}</div>
            </div>
        </div>
    </div>
</div>
