<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOPLA – @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 antialiased">
    <div class="flex h-screen overflow-hidden">

        <x-sidebar />

        <div class="flex flex-col flex-1 min-w-0 overflow-hidden">
            <x-topbar />
            <main class="flex-1 overflow-y-auto p-8">
                @yield('content')
            </main>
        </div>

    </div>
    @stack('scripts')
</body>
</html>
