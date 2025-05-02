<div class="shadow-md bg-white flex justify-center min-h-screen p-6">
    <div class="p-6">
        @if($codigo != "")
            <h2 class="text-2xl font-bold text-center p-4">Código: NI-{{ $codigo }}</h2>
        @else
            <h2 class="text-2xl font-bold text-center p-4">Fotos no disponibles</h2>
        @endif
        @foreach($fotos as $foto)
            <div class="p-8 shadow-md">
                <img width="300px" src="{{ asset($foto->archivo_foto) }}" alt="a">
            </div>
        @endforeach
    </div>
</div>
