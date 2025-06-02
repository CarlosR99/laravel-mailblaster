<div class="card h-full">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold text-lg text-gray-800 dark:text-white">Campañas recientes</h2>
        <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">
            Ver todas
        </a>
    </div>
    
    <div class="space-y-4">
        @foreach([
            [
                'title' => 'Campaña de Verano 2024',
                'date' => '05/06/2024',
                'emails' => '1,234 enviados',
                'status' => 'Activa',
                'color' => 'indigo'
            ],
            [
                'title' => 'Oferta Especial Mayo',
                'date' => '02/06/2024',
                'emails' => '987 enviados',
                'status' => 'Completada',
                'color' => 'green'
            ],
            [
                'title' => 'Newsletter Abril',
                'date' => '28/05/2024',
                'emails' => '2,045 enviados',
                'status' => 'Programada',
                'color' => 'blue'
            ]
        ] as $campaign)
        <div class="border-l-4 border-{{ $campaign['color'] }}-500 pl-4 py-1">
            <div class="flex justify-between">
                <h3 class="font-medium text-gray-800 dark:text-white">{{ $campaign['title'] }}</h3>
                <span class="badge badge-{{ $campaign['color'] }}">{{ $campaign['status'] }}</span>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $campaign['date'] }} - {{ $campaign['emails'] }}</p>
        </div>
        @endforeach
    </div>
    
    <button class="mt-6 w-full py-2.5 border border-dashed border-gray-300 dark:border-gray-600 rounded-lg text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 text-sm font-medium flex items-center justify-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
        </svg>
        Nueva campaña
    </button>
</div>