@php
    $editing = isset($encargado);
@endphp
<form class="shadow-md p-6 rounded-xl"
      action="{{ $editing ? route('user.edit.encargado',
      ['id_user'=> $encargado->id_usuario, 'id_persona' => $encargado->id_persona, 'id_encargado' => $encargado->id_encargado]) : route('user.register') }}"
      method="post">
    @csrf
    <div class="space-y-12">
        <input type="hidden" name="rol" value="{{ \App\enums\TipoRol::ENCARGADO }}">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base/7 font-semibold text-gray-900">Informacion personal</h2>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                <div class="sm:col-span-3">
                    <label for="nombre1" class="block text-sm/6 font-medium text-gray-900">*Primer nombre</label>
                    <div class="mt-2">
                        <input type="text" name="nombre1" id="nombre1" autocomplete="given-name"
                               placeholder="Primer nombre" required
                               value="{{ $editing ? $encargado->nombre1 : '' }}"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="nombre2" class="block text-sm/6 font-medium text-gray-900">Segundo nombre</label>
                    <div class="mt-2">
                        <input type="text" name="nombre2" id="nombre2" autocomplete="family-name"
                               placeholder="Segundo nombre"
                               value="{{ $editing ? $encargado->nombre2 : '' }}"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="apellido1" class="block text-sm/6 font-medium text-gray-900">*Primer
                        apellido</label>
                    <div class="mt-2">
                        <input type="text" name="apellido1" id="apellido1" autocomplete="given-name"
                               placeholder="Primer apellido"
                               value="{{ $editing ? $encargado->apellido1 : '' }}"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="apellido2" class="block text-sm/6 font-medium text-gray-900">Segundo
                        apellido</label>
                    <div class="mt-2">
                        <input type="text" name="apellido2" id="apellido2" autocomplete="family-name"
                               placeholder="Segundo apellido"
                               value="{{ $editing ? $encargado->apellido2 : '' }}"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">*Correo electrónico</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email"
                               placeholder="Correo" required
                               value="{{ $editing ? $encargado->correo : '' }}"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="dpi" class="block text-sm/6 font-medium text-gray-900">*DPI</label>
                    <div class="mt-2">
                        <input id="dpi" name="dpi" type="text" autocomplete="dpi" required
                               pattern="^[0-9]{13}$" title="Ingrese su numero de DPI" placeholder="Número de DPI"
                               value="{{ $editing ? $encargado->dpi : '' }}"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="telefono" class="block text-sm/6 font-medium text-gray-900">*Teléfono</label>
                    <div class="mt-2">
                        <input id="telefono" name="telefono" type="text" autocomplete="telefono" required
                               pattern="^[0-9]{8}" placeholder="Número de teléfono" title="Número de teléfon"
                               value="{{ $editing ? $encargado->telefono : '' }}"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="genero" class="block text-sm/6 font-medium text-gray-900">*Género</label>
                    <div class="mt-2 grid grid-cols-1">
                        <select id="genero" name="genero" autocomplete="genero-name" required
                                class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @if($editing)
                                @if($encargado->genero == 'M')
                                    <option value="M">Masculino</option>
                                @else
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

                <div class="col-span-full">
                    <label for="street-address" class="block text-sm/6 font-medium text-gray-900">*Dirección</label>
                    <div class="mt-2">
                        <input type="text" name="address" id="street-address" autocomplete="street-address"
                               placeholder="Ingrese su dirección" required
                               value="{{ $editing ? $encargado->direccion : '' }}"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="username" class="block text-sm/6 font-medium text-gray-900">*Nombre de
                        usuario</label>
                    <div class="mt-2">
                        <input type="text" name="username" id="username" autocomplete="given-name"
                               placeholder="Ingrese un nombre de usuario" required
                               value="{{ $editing ? $encargado->username : '' }}"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>
                @if(!$editing)
                    <div class="sm:col-span-3">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">*Contraseña</label>
                        <div class="mt-2">
                            <input type="password" name="password" id="password" autocomplete="family-name" required
                                   class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        @if(!$editing)
            <button type="reset" class="text-sm/6 font-semibold text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md
                        transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-100">Cancelar
            </button>
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                        transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-100">Registrar encargado
            </button>
        @else
            <a href="{{ route('user.encargados') }}" type="reset" class="text-sm/6 font-semibold text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md
                        transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-100">Cancelar
            </a>
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                        transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-100">Guardar cambios
            </button>
        @endif
    </div>
</form>
