<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-100 font-sans antialiased">
    @php
        $currentUser = Auth::user();
        $currentUserName = $currentUser?->name ?? 'Invitado';
        $currentUserEmail = $currentUser?->email ?? 'Sin sesión activa';
    @endphp
    {{-- Wrapper principal --}}
    <div class="flex h-screen overflow-hidden">
        {{-- ===================== SIDEBAR ===================== --}}
        <aside
            id="sidebar"
            class="flex flex-col w-64 min-h-screen bg-slate-900 text-slate-300
                   transition-all duration-300 ease-in-out
                   fixed inset-y-0 left-0 z-50
                   md:static md:translate-x-0
                   -translate-x-full"
        >
            {{-- Logo / Marca --}}
            <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-700/60">
                <div class="w-8 h-8 rounded-lg bg-sky-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="text-white font-semibold text-base tracking-tight">
                    {{ config('app.name') }}
                </span>
            </div>
            {{-- Navegación principal --}}
            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
                {{-- Sección: Principal --}}
                <p class="px-3 pt-2 pb-1 text-xs font-semibold uppercase tracking-widest
                           text-slate-500 select-none">
                    Principal
                </p>
    @php
        $navItems = [
            ['route' => 'dashboard',   'label' => 'Dashboard',   'icon' => 'home'],
            ['route' => 'alumnos.index', 'label' => 'Alumnos',   'icon' => 'users'],
        ];
    @endphp
                @foreach ($navItems as $item)
                    @php
                        $isActive = request()->routeIs($item['route'] . '*');
                    @endphp
                    <a href="{{ route($item['route']) }}"
                       class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm
                              transition-all duration-150
                              {{ $isActive
                                  ? 'bg-sky-600/20 text-sky-400 font-medium'
                                  : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                        {{-- Ícono dinámico --}}
                        @include('layouts.partials.sidebar-icon', ['icon' => $item['icon'], 'active' => $isActive])
                        {{ $item['label'] }}
                        @if ($isActive)
                            <span class="ml-auto w-1.5 h-1.5 rounded-full bg-sky-400"></span>
                        @endif
                    </a>
                @endforeach
                {{-- Sección: Configuración --}}
                <p class="px-3 pt-5 pb-1 text-xs font-semibold uppercase tracking-widest
                           text-slate-500 select-none">
                    Configuración
                </p>
                <a href="{{ route('profile.edit') }}"
                   class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm
                          transition-all duration-150
                          {{ request()->routeIs('profile.*')
                              ? 'bg-sky-600/20 text-sky-400 font-medium'
                              : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                    @include('layouts.partials.sidebar-icon', ['icon' => 'profile', 'active' => request()->routeIs('profile.*')])
                    Mi Perfil
                </a>
            </nav>
            {{-- Footer del sidebar: usuario logueado --}}
            <div class="border-t border-slate-700/60 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center
                                text-xs font-bold text-slate-300 flex-shrink-0">
                        {{ strtoupper(substr($currentUserName, 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-200 truncate">
                            {{ $currentUserName }}
                        </p>
                        <p class="text-xs text-slate-500 truncate">
                            {{ $currentUserEmail }}
                        </p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="text-slate-500 hover:text-red-400 transition-colors"
                                title="Cerrar sesión">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3
                                         3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>
    {{-- ================== FIN SIDEBAR ================== --}}
        {{-- Overlay para mobile --}}
        <div id="sidebar-overlay"
             class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"
             onclick="toggleSidebar()">
        </div>
        {{-- ===================== CONTENIDO ===================== --}}
        <div class="flex flex-col flex-1 overflow-hidden">
            {{-- Topbar --}}
            <header class="flex items-center justify-between
                           bg-white border-b border-slate-200
                           px-4 md:px-6 h-16 flex-shrink-0">
                {{-- Botón hamburguesa (mobile) --}}
                <button onclick="toggleSidebar()"
                        class="md:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100
                               transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                {{-- Título de página --}}
                <h1 class="text-base font-semibold text-slate-800">
                    {{ $title ?? 'Dashboard' }}
                </h1>
                {{-- Acciones del topbar (slot opcional) --}}
                <div class="flex items-center gap-2">
                    @yield('actions')
                </div>
            </header>
            {{-- Contenido principal --}}
            <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
                @yield('slot')
            </main>
        </div>
    {{-- ============== FIN CONTENIDO ============== --}}
    </div>
    {{-- Script sidebar mobile --}}
    <script>
        function toggleSidebar() {
            const sidebar  = document.getElementById('sidebar');
            const overlay  = document.getElementById('sidebar-overlay');
            const isOpen   = !sidebar.classList.contains('-translate-x-full');
            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            } else {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }
        }
    </script>
    </body>
</html>
