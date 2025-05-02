<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body >
@include('utils.header-nichos')
<div class="bg-white flex items-center justify-center min-h-screen">
    @include('utils.alerts')
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-2xl shadow-xl">
        <h2 class="text-2xl font-bold text-center text-gray-800">Iniciar Sesión</h2>
        <form class="space-y-4" action="{{ route('user.login') }}" method="post">
            @csrf

            <div>
                <label for="username" class="block text-sm font-medium text-gray-900">Usuario</label>
                <input type="text" id="username" name="username" required
                       class="block w-full rounded-xl bg-white px-4 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-900">Contraseña</label>
                <input type="password" id="password" name="password" required
                       class="block w-full rounded-xl bg-white px-4 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600">
            </div>
            <div>
                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 rounded-xl hover:bg-indigo-500 transition duration-200">
                    Ingresar
                </button>
            </div>
        </form>
        <p class="flex justify-end">
            <a class="transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110" href="/register">Registrarme</a>
        </p>
    </div>
</div>

@vite('resources/js/alerts.js')

</body>
</html>
