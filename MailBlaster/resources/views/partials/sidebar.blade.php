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
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-indigo-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('campaigns.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-indigo-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                    </svg>
                    <span>Campañas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-indigo-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span>Usuarios</span>
                </a>
            </li>
            <li>
                <a href="{{ route('reports.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-indigo-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Reportes</span>
                </a>
            </li>
            <li>
                <a href="{{ route('templates.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg bg-gradient-to-r from-yellow-500 to-yellow-600 text-white shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                    </svg>
                    <span>Plantillas</span>
                </a>
            </li>
        </ul>
        
        <div class="mt-6 px-2">
            <h3 class="px-4 text-xs font-semibold text-indigo-300 uppercase tracking-wider">CONFIGURACIÓN</h3>
            <ul class="mt-2 space-y-1">
                <li>
                    <a href="{{ route('settings.edit') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-indigo-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Ajustes</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logs.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-indigo-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Registros</span>
                    </a>
                </li>
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
                <p class="text-xs text-indigo-300">Administrador</p>
            </div>
        </div>
    </div>
</div>