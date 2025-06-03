<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    @include('partials.head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trix@2.0.0/dist/trix.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body
    class="min-h-screen bg-gray-50 text-gray-900 flex flex-col"
    x-data="{
        sidebarOpen: false,
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
        }
    }"
    x-init="
        window.addEventListener('resize', () => {
            if(window.innerWidth < 1024) sidebarOpen = false;
        });
    "
    x-cloak
>
    @include('partials.navbar')

    <div class="flex flex-1 pt-16 min-h-0">
        <!-- Sidebar -->
        <aside
            class="fixed top-16 left-0 z-30 w-64 bg-indigo-800 text-white transform transition-transform duration-300 h-[calc(100vh-4rem-4rem)] shadow-xl"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            x-show="sidebarOpen || window.innerWidth >= 1024"
            x-transition
            x-cloak
        >
            @include('partials.sidebar')
        </aside>

        <!-- Contenido Principal -->
        <div class="flex-1 flex flex-col min-h-0 transition-all duration-300"
             :class="{'md:ml-64': sidebarOpen}">
            <main class="flex-1 overflow-auto p-4 pb-20">
                @yield('admin-content')
            </main>

            <!-- Footer fijo abajo -->
            <div class="fixed left-0 right-0 bottom-0 z-40">
                @include('partials.footer')
            </div>
        </div>
    </div>

    <!-- Overlay para móvil -->
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