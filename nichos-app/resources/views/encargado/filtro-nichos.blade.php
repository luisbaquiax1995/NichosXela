<div>
    <form class="flex flex-row" method="post" action="{{ route('contratos.getByEstado')}}">
        @csrf
        <input type="hidden" name="statusNicho" value="{{ \App\enums\EstadoNicho::STATUS_NORMAL }}">
        <div class="sm:col-span-3">
            <p class="text-xs text-gray-600">Filtar por estado</p>
            <div class="mt-2 grid grid-cols-1">
                <select id="estado" name="estado" autocomplete="genero-name" required
                        class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    <option value="{{ \App\enums\TipoContrato::ACTIVO }}">{{ \App\enums\TipoContrato::ACTIVO }}</option>
                    <option value="{{ \App\enums\TipoContrato::A_PUNTO_DE_VENCER }}">{{ \App\enums\TipoContrato::A_PUNTO_DE_VENCER }}</option>
                    <option value="{{ \App\enums\TipoContrato::EN_AÑO_DE_GRACIA }}">{{ \App\enums\TipoContrato::EN_AÑO_DE_GRACIA }}</option>
                    <option value="{{ \App\enums\TipoContrato::CADUCADO }}">{{ \App\enums\TipoContrato::CADUCADO }}</option>
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
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
    </form>
</div>
