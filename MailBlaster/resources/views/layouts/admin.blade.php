<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'MailBlaster Admin' }}</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trix@2.0.0/dist/trix.min.css">
    <script>
        function applyTheme(theme) {
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }

        // Inicializar tema al cargar
        document.addEventListener('DOMContentLoaded', function() {
            let theme = localStorage.theme;
            if (!theme) {
                theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }
            applyTheme(theme);
        });

        // Definir la función global para el botón
        window.toggleTheme = function() {
            let isDark = document.documentElement.classList.toggle('dark');
            localStorage.theme = isDark ? 'dark' : 'light';
            applyTheme(localStorage.theme);
        }
    </script>
</head>
<body
    class="min-h-screen bg-gray-50 dark:bg-zinc-900 text-gray-900 dark:text-gray-100 flex flex-col"
    x-data="{
        sidebarOpen: JSON.parse(localStorage.getItem('sidebarOpen')) ?? (window.innerWidth >= 1024),
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
            localStorage.setItem('sidebarOpen', JSON.stringify(this.sidebarOpen));
        }
    }"
    x-init="$watch('sidebarOpen', value => localStorage.setItem('sidebarOpen', JSON.stringify(value)))"
    x-cloak
>
    <!-- Navbar Fijo -->
    <nav class="fixed top-0 left-0 right-0 z-40 h-16 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 py-3 flex justify-between items-center">
        <button @click="toggleSidebar" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                <path x-show="sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        
        <h1 class="text-xl font-bold text-gray-800 dark:text-white">
            MailBlaster Admin
        </h1>
        
        <div class="flex items-center gap-4">
            <button id="theme-toggle" type="button" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700" onclick="toggleTheme()">
                <svg id="theme-toggle-dark-icon" class="w-5 h-5 text-gray-500 dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="w-5 h-5 text-yellow-400 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.47a1 1 0 011.42 1.42l-.7.7a1 1 0 11-1.42-1.42l.7-.7zM18 9a1 1 0 100 2h-1a1 1 0 100-2h1zm-2.47 4.22a1 1 0 011.42 1.42l-.7.7a1 1 0 11-1.42-1.42l.7-.7zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-2.47a1 1 0 00-1.42 1.42l.7.7a1 1 0 001.42-1.42l-.7-.7zM4 11a1 1 0 100-2H3a1 1 0 100 2h1zm2.47-4.22a1 1 0 00-1.42-1.42l-.7.7a1 1 0 001.42 1.42l.7-.7z" />
                </svg>
            </button>
            
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center">
                        <span class="text-white font-medium">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                </button>
                
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-md shadow-lg py-1 z-50">
                    <div class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                        {{ Auth::user()->name }}
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenedor Principal -->
    <div class="flex flex-1 pt-16 min-h-0">
        <!-- Sidebar con altura ajustada para no superponer footer -->
        <aside class="fixed top-16 left-0 z-30 w-64 bg-gray-800 text-white transform transition-transform duration-300 h-[calc(100vh-4rem-4rem)]"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            @include('partials.sidebar')
        </aside>

        <!-- Contenido Principal -->
        <div class="flex-1 flex flex-col min-h-0 transition-all duration-300"
             :class="{'md:ml-64': sidebarOpen}">
            <main class="flex-1 overflow-auto p-4 pb-20">
                @yield('admin-content')
            </main>

            <!-- Footer fijo abajo, igual que el navbar -->
            <div class="fixed left-0 right-0 bottom-0 z-40">
                @include('partials.footer')
            </div>
        </div>
    </div>

    <!-- Overlay para móvil con altura ajustada -->
    <div x-show="sidebarOpen && window.innerWidth < 1024" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/50 z-20 top-16 h-[calc(100vh-4rem)]"
         @click="sidebarOpen = false"
         style="display: none;">
    </div>

    @stack('scripts')
</body>
</html>