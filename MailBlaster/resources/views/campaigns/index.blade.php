@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold mb-4">Campañas</h1>
    <a href="{{ route('campaigns.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Nueva campaña</a>
    <div class="bg-white rounded shadow p-4 overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Plantilla</th>
                    <th class="px-4 py-2">Total emails</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($campaigns as $campaign)
                <tr>
                    <td class="px-4 py-2">{{ $campaign->name }}</td>
                    <td class="px-4 py-2">{{ ucfirst($campaign->template) }}</td>
                    <td class="px-4 py-2">{{ $campaign->total_emails }}</td>
                    <td class="px-4 py-2">{{ ucfirst($campaign->status) }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('campaigns.report', $campaign) }}" class="text-blue-600 hover:underline">Ver reporte</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection