@php
    $calles = \App\Http\Controllers\CalleController::getCalles(\App\Models\Calle::CALLE);
    $avenidas = \App\Http\Controllers\CalleController::getCalles(\App\Models\Calle::AVENIDA);
@endphp
@php
    $editing = isset($nicho);
@endphp
<div class="p-6 bg-white flex items-center justify-center">
    <form class="shadow-md p-6 rounded-xl"
          method="post"
          action="{{ ($editing) ? route('nicho.edit', ['id' => $nicho->codigo]) : route('nicho.add') }}"
    >
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-3xl font-bold  text-gray-900 text-center">{{ ($editing) ? 'Edición de nicho' : 'Información del nuevo nicho' }}</h2>

                <p class="font-semibold">{{ (!$editing) ? '*El código del nicho se genera automáticamente.' : '' }}</p>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <div class="sm:col-span-2">
                        <label for="calle" class="block text-sm/6 font-medium text-gray-900">Calle</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="calle" name="calle" required
                                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                @if($editing)
                                    <option value="{{ $nicho->id_calle }}">{{ $nicho->numero1 }},{{ $nicho->calle }}</option>
                                @endif
                                @foreach($calles as $calle)
                                    <option value="{{ $calle->id_calle }}">{{ $calle->numero_calle }}, {{ $calle->nombre_calle }}</option>
                                @endforeach
                            </select>
                            <svg
                                class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                      d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="avenida" class="block text-sm/6 font-medium text-gray-900">Avenida</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="avenida" name="avenida" required
                                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                @if($editing)
                                    <option value="{{ $nicho->id_avenida }}">{{ $nicho->numero2 }},{{ $nicho->avenida }}</option>
                                @endif
                                @foreach($avenidas as $calle)
                                    <option value="{{ $calle->id_calle }}">{{ $calle->numero_calle }}, {{ $calle->nombre_calle }}</option>
                                @endforeach
                            </select>
                            <svg
                                class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                      d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="tipo" class="block text-sm/6 font-medium text-gray-900">Tipo nicho</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="tipo" name="tipo" required
                                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                <option value="{{ \App\enums\EstadoNicho::TIPO_ADULTO }}">{{ \App\enums\EstadoNicho::TIPO_ADULTO }}</option>
                                <option value="{{ \App\enums\EstadoNicho::TIPO_INFANTIL }}">{{ \App\enums\EstadoNicho::TIPO_INFANTIL }}</option>
                            </select>
                            <svg
                                class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                      d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="status" class="block text-sm/6 font-medium text-gray-900">Status</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="status" name="status" required
                                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                @if($editing)
                                    <option value="{{ $nicho->status }}">
                                        {{ ($nicho->status == \App\enums\EstadoNicho::STATUS_NORMAL) ? \App\enums\EstadoNicho::STATUS_NORMAL : \App\enums\EstadoNicho::STATUS_ESPECIAL }}</option>
                                @endif
                                <option value="{{ \App\enums\EstadoNicho::STATUS_NORMAL }}">{{ \App\enums\EstadoNicho::STATUS_NORMAL }}</option>
                                <option value="{{ \App\enums\EstadoNicho::STATUS_ESPECIAL }}">{{ \App\enums\EstadoNicho::STATUS_ESPECIAL }}</option>
                            </select>
                            <svg
                                class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                      d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-center gap-x-6">
            @if(!$editing)
                <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                        transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-100">Registrar nicho
                </button>
            @else
                <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                        transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-100">Guardar cambios
                </button>
            @endif
        </div>
    </form>
</div>


