<nav class="fixed top-0 left-0 right-0 z-50 h-16 bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-4 py-3 flex justify-between items-center shadow-lg">
    <!-- Botón SIEMPRE visible -->
    <button @click="sidebarOpen = !sidebarOpen" class="text-white hover:text-blue-100 mr-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            <path x-show="sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    <h1 class="text-xl font-bold">
        <span class="bg-white text-blue-600 px-2 py-1 rounded mr-1">Mail</span>Blaster Admin
    </h1>

    <div class="flex items-center gap-4">
        <!-- Menú de usuario igual que antes -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center border-2 border-yellow-400">
                    <span class="text-blue-600 font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
            </button>
            <div x-show="open" @click.away="open = false" x-transition x-cloak
                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-blue-200">
                <div class="px-4 py-2 text-sm text-blue-800 font-medium">
                    {{ Auth::user()->name }}
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-blue-600 hover:bg-blue-50">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>