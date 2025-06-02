<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach([
        [
            'title' => 'Campañas activas',
            'value' => '12',
            'trend' => '↑ 2.5%',
            'description' => 'desde el mes pasado',
            'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6',
            'color' => 'indigo'
        ],
        [
            'title' => 'Correos enviados',
            'value' => '1,234',
            'trend' => '↑ 12.3%',
            'description' => 'desde ayer',
            'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
            'color' => 'green'
        ],
        [
            'title' => 'Usuarios registrados',
            'value' => '8',
            'trend' => '↑ 3 nuevos',
            'description' => 'en los últimos 7 días',
            'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
            'color' => 'blue'
        ]
    ] as $stat)
    <div class="card">
        <div class="stat-card">
            <div>
                <p class="text-gray-500 dark:text-gray-400 text-sm">{{ $stat['title'] }}</p>
                <p class="text-2xl font-bold mt-1 dark:text-white">{{ $stat['value'] }}</p>
            </div>
            <div class="stat-icon bg-{{ $stat['color'] }}-100 dark:bg-{{ $stat['color'] }}-900/30 text-{{ $stat['color'] }}-600 dark:text-{{ $stat['color'] }}-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/>
                </svg>
            </div>
        </div>
        <div class="mt-3 text-sm text-{{ $stat['color'] }}-600 dark:text-{{ $stat['color'] }}-400 flex items-center">
            <span>{{ $stat['trend'] }}</span>
            <span class="ml-1">{{ $stat['description'] }}</span>
        </div>
    </div>
    @endforeach
</div>