<nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 py-3 flex justify-between items-center">
    <div class="flex items-center">
        <button class="mr-3 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 lg:hidden"
                @click="sidebarOpen = !sidebarOpen">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <h1 class="text-xl font-bold text-gray-800 dark:text-white">
            <span class="hidden md:inline">MailBlaster Admin</span>
            <span class="md:hidden">MB Admin</span>
        </h1>
    </div>
    
    <div class="flex items-center gap-4">
        <!-- Botón para modo oscuro/claro -->
        <button id="theme-toggle" type="button" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700" onclick="toggleTheme()">
            <svg class="w-5 h-5 text-gray-500 dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                <!-- Luna -->
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
            <svg class="w-5 h-5 text-yellow-400 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                <!-- Sol -->
                <circle cx="10" cy="10" r="5" />
            </svg>
            <span class="ml-2">Tema</span>
        </button>
        
        <div class="relative">
            <button class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
        </div>
        
        <div class="relative group">
            <div class="flex items-center space-x-2 cursor-pointer">
                <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center">
                    <span class="text-white font-medium">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
                <span class="hidden md:inline text-sm font-medium">{{ Auth::user()->name }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
            <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 hidden group-hover:block z-50">
                <form method="POST" action="{{ route('logout') }}" class="block w-full text-left">
                    @csrf
                    <button type="submit" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>