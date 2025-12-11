<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Gestão')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="{{ route('groups.index') }}" class="flex items-center px-3 text-lg font-semibold">Gestão</a>
                    <div class="ml-6 flex items-center space-x-4">
                        <a href="{{ route('groups.index') }}" class="text-gray-700 hover:text-gray-900">Grupos</a>
                        <a href="{{ route('brands.index') }}" class="text-gray-700 hover:text-gray-900">Bandeiras</a>
                        <a href="{{ route('units.index') }}" class="text-gray-700 hover:text-gray-900">Unidades</a>
                        <a href="{{ route('collaborators.index') }}" class="text-gray-700 hover:text-gray-900">Colaboradores</a>
                        <a href="{{ route('reports.collaborators') }}" class="text-gray-700 hover:text-gray-900">Relatórios</a>
                    </div>
                </div>
                <div class="flex items-center">
                    @auth
                        <span class="mr-4 text-sm text-gray-600">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-red-600">Sair</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 mr-4">Login</a>
                        <a href="{{ route('register') }}" class="text-sm text-gray-700">Registrar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </main>
</body>
</html>