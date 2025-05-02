<div class="shadow-md bg-white flex justify-center min-h-screen p-6">

    <div class="p-6">
        <div class="mb-3">
            <a class="p-3 font-semibold text-semibold rounded-xlshadow-lg flex flex-row"
               href="javascript:history.back()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mx-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                Regresar
            </a>
        </div>
        @if($codigo != "")
            <h2 class="text-2xl font-bold text-center p-4">Código: NI-{{ $codigo }}</h2>
        @else
            <h2 class="text-2xl font-bold text-center p-4">Fotos no disponibles</h2>
        @endif
        <div class="columns-3">
            @foreach($fotos as $foto)
                <div class="p-8 shadow-md">
                    <img width="300px" src="{{ asset($foto->archivo_foto) }}" alt="a">
                </div>
            @endforeach
        </div>
    </div>
</div>
