@php
    $editing = isset($ocupante);
    $withPersona = isset($persona);
    $departamentos = \App\Http\Controllers\DepartamentoController::departamentos();
    $tiposMuerte = \App\Http\Controllers\TipoMuerteController::listaTipoMuerte();
@endphp
<form class="shadow-md p-6 rounded-xl"
      action="{{ $editing ? route('update.ocupante',['id'=>$ocupante->id_ocupante]) : route('add.ocupante') }}"
      method="post"
      >
    @csrf
    <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base/7 font-semibold text-gray-900">Informacion personal del ocupante</h2>

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <label for="dpi" class="block text-sm/6 font-medium text-gray-900">*DPI</label>
                <div class="mt-2">
                    <input id="dpi" name="dpi" type="text" autocomplete="dpi" required
                           pattern="^[0-9]{13}$" title="Ingrese el numero de DPI" placeholder="Número de DPI"
                           value="{{ old('dpi', $editing ? $ocupante->dpi : ($withPersona ? $persona->dpi : '')) }}"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="tipo" class="block text-sm/6 font-medium text-gray-900">*Tipo de cupante</label>
                <div class="mt-2 grid grid-cols-1">
                    <select id="tipo" name="tipo"
                            class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @if($editing)
                            <option value="{{ $ocupante->tipo }}">{{ $ocupante->tipo }}</option>
                        @endif
                        <option value="{{ \App\enums\TipoOcupante::NORMAL }}">{{ \App\enums\TipoOcupante::NORMAL }}</option>
                        <option value="{{ \App\enums\TipoOcupante::PRIVILEGIADO }}">{{ \App\enums\TipoOcupante::PRIVILEGIADO }}</option>
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
                <label for="nombre1" class="block text-sm/6 font-medium text-gray-900">*Primer nombre</label>
                <div class="mt-2">
                    <input type="text" name="nombre1" id="nombre1" autocomplete="given-name" required
                           placeholder="Primer nombre"
                           value="{{ old('nombre1', $editing ? $ocupante->nombre1 : ($withPersona ? $persona->nombre1 : '')) }}"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="nombre2" class="block text-sm/6 font-medium text-gray-900">Segundo nombre</label>
                <div class="mt-2">
                    <input type="text" name="nombre2" id="nombre2" autocomplete="family-name"
                           placeholder="Segundo nombre"
                           value="{{ old('nombre2', $editing ? $ocupante->nombre2 : ($withPersona ? $persona->nombre2 : '')) }}"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="apellido1" class="block text-sm/6 font-medium text-gray-900">
                    *Primer apellido
                </label>
                <div class="mt-2">
                    <input type="text" name="apellido1" id="apellido1" autocomplete="given-name"
                           placeholder="Primer apellido"
                           value="{{ old('apellido1', $editing ? $ocupante->apellido1 : ($withPersona ? $persona->apellido1 : '')) }}"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="apellido2" class="block text-sm/6 font-medium text-gray-900">Segundo
                    apellido</label>
                <div class="mt-2">
                    <input type="text" name="apellido2" id="apellido2" autocomplete="family-name"
                           placeholder="Segundo apellido"
                           value="{{ old('apellido2', $editing ? $ocupante->nombre2 : ($withPersona ? $persona->apellido2 : '')) }}"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
            </div>

            <div class="sm:col-span-2">
                <label for="nacimiento" class="block text-sm/6 font-medium text-gray-900">
                    *Fecha de nacimiento
                </label>
                <div class="mt-2">
                    <input type="date" name="nacimiento" id="nacimiento" autocomplete="given-name" required
                           value="{{ old('nacimiento', $editing ? $ocupante->fecha_nacimiento : '') }}"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
            </div>

            <div class="sm:col-span-2">
                <label for="fallecimiento" class="block text-sm/6 font-medium text-gray-900">
                    *Fecha de fallecimiento
                </label>
                <div class="mt-2">
                    <input type="date" name="fallecimiento" id="fallecimiento" autocomplete="given-name" required
                           value="{{ old('fallecimiento', $editing ? $ocupante->fecha_fallecimiento : '') }}"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
            </div>

            <div class="sm:col-span-2">
                <label for="genero" class="block text-sm/6 font-medium text-gray-900">*Género</label>
                <div class="mt-2 grid grid-cols-1">
                    <select id="genero" name="genero"
                            class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @if($editing)
                            @if($ocupante->genero == 'M')
                                <option value="M">Masculino</option>
                            @else
                                <option value="F">Femenino</option>
                            @endif
                        @endif
                        @if($withPersona)
                                @if($persona->genero == 'M')
                                    <option value="M">Masculino</option>
                                @elseif($persona->genero == 'F')
                                    <option value="F">Femenino</option>
                                @endif
                        @endif
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
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
                <label for="procedencia" class="block text-sm/6 font-medium text-gray-900">Lugar de procedencia</label>
                <div class="mt-2">
                    <input type="text" name="procedencia" id="procedencia"
                           placeholder="Lugar de procedencia..."
                           value="{{ old('procedencia', $editing ? $ocupante->procedencia : '') }}"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
            </div>

            <div class="sm:col-span-2">
                <label for="departamento" class="block text-sm/6 font-medium text-gray-900">*Departamento</label>
                <div class="mt-2 grid grid-cols-1">
                    <select id="departamento" name="departamento" required
                            class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @if($editing)
                            <option value="{{ $ocupante->id_depto }}">{{ $ocupante->nombre_departamento }}</option>
                        @else
                            <option value="0">Seleccione departamento</option>
                        @endif
                        @foreach($departamentos as $departamento)
                            <option value="{{ $departamento->id_depto }}">{{ $departamento->nombre_departamento }}</option>
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
                <label for="municipio" class="block text-sm/6 font-medium text-gray-900">*Municipio</label>
                <div class="mt-2 grid grid-cols-1">
                    <select id="municipio" name="municipio" required
                            class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @if($editing)
                            <option value="{{ $ocupante->id_municipio }}">{{ $ocupante->nombre_municipio }}</option>
                            <option value="0">Seleccione departamento</option>
                        @endif
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
            @if(!$editing)
                <div class="sm:col-span-3">
                    <label for="muerte" class="block text-sm/6 font-medium text-gray-900">*Causa de Muerte</label>
                    <div class="mt-2 grid grid-cols-1">
                        <select id="muerte" name="muerte[]" multiple required
                                class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @foreach($tiposMuerte as $muerte)
                                <option value="{{ $muerte->id_tipo_muerte }}">{{ $muerte->descripcion }}</option>
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
            @endif
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        @if($editing)
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                        transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-100">Guardar cambios
            </button>
        @else
            <button type="reset" class="text-sm/6 font-semibold text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md
                        transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-100">Cancelar
            </button>
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                        transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-100">Registrar usuario
            </button>
        @endif
    </div>
</form>


