<div class="h-full flex flex-col bg-indigo-800 text-white">
    <div class="p-4 border-b border-indigo-700 flex items-center">
        <div class="bg-white border-2 border-yellow-400 rounded-xl w-10 h-10 flex items-center justify-center">
            <span class="text-indigo-600 font-bold">M</span>
        </div>
        <div class="ml-3">
            <h3 class="font-bold">MailBlaster</h3>
            <p class="text-xs text-indigo-300">Panel de administración</p>
        </div>
    </div>
    
    <nav class="flex-1 py-4 overflow-y-auto">
        <ul class="space-y-1 px-2">
            <li>
                <a href="{{ Auth::user()->hasRole('administrador') ? route('admin.dashboard') : route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors
                   @if(request()->routeIs('dashboard') || request()->routeIs('admin.dashboard')) bg-gradient-to-r from-yellow-500 to-yellow-600 text-white shadow @else hover:bg-indigo-700 @endif">
                    <!-- icono -->
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('campaigns.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors
                   @if(request()->routeIs('campaigns.*')) bg-gradient-to-r from-yellow-500 to-yellow-600 text-white shadow @else hover:bg-indigo-700 @endif">
                    <!-- icono -->
                    <span>Campañas</span>
                </a>
            </li>
            @if(Auth::user()->hasRole('administrador'))
            <li>
                <a href="{{ route('users.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors
                   @if(request()->routeIs('users.*')) bg-gradient-to-r from-yellow-500 to-yellow-600 text-white shadow @else hover:bg-indigo-700 @endif">
                    <!-- icono -->
                    <span>Usuarios</span>
                </a>
            </li>
            <li>
                <a href="{{ route('reports.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors
                   @if(request()->routeIs('reports.*')) bg-gradient-to-r from-yellow-500 to-yellow-600 text-white shadow @else hover:bg-indigo-700 @endif">
                    <!-- icono -->
                    <span>Reportes</span>
                </a>
            </li>
            @endif
            <li>
                <a href="{{ route('templates.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors
                   @if(request()->routeIs('templates.*')) bg-gradient-to-r from-yellow-500 to-yellow-600 text-white shadow @else hover:bg-indigo-700 @endif">
                    <!-- icono -->
                    <span>Plantillas</span>
                </a>
            </li>
        </ul>
        <div class="mt-6 px-2">
            <h3 class="px-4 text-xs font-semibold text-indigo-300 uppercase tracking-wider">CONFIGURACIÓN</h3>
            <ul class="mt-2 space-y-1">
                <li>
                    <a href="{{ route('settings.edit') }}"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors
                       @if(request()->routeIs('settings.*') || request()->routeIs('ajustes')) bg-gradient-to-r from-yellow-500 to-yellow-600 text-white shadow @else hover:bg-indigo-700 @endif">
                        <!-- icono -->
                        <span>Ajustes</span>
                    </a>
                </li>
                @if(Auth::user()->hasRole('administrador'))
                <li>
                    <a href="{{ route('logs.index') }}"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors
                       @if(request()->routeIs('logs.*')) bg-gradient-to-r from-yellow-500 to-yellow-600 text-white shadow @else hover:bg-indigo-700 @endif">
                        <!-- icono -->
                        <span>Registros</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </nav>
    
    <div class="p-4 border-t border-indigo-700 mt-auto">
        <div class="flex items-center gap-3">
            <div class="relative">
                <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center">
                    <span class="text-indigo-600 font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-indigo-800"></div>
            </div>
            <div>
                <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                <p class="text-xs text-indigo-300">
                    {{ Auth::user()->hasRole('administrador') ? 'Administrador' : 'Publicista' }}
                </p>
            </div>
        </div>
    </div>
</div>