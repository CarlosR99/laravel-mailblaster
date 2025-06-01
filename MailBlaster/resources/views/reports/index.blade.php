@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold mb-4">Reportes de campañas</h1>
    <div class="bg-white rounded shadow p-4 overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Campaña</th>
                    <th class="px-4 py-2">Enviados</th>
                    <th class="px-4 py-2">Fallidos</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Ver detalle</th>
                </tr>
            </thead>
            <tbody>
                @foreach($campaigns as $campaign)
                <tr>
                    <td class="px-4 py-2">{{ $campaign->name }}</td>
                    <td class="px-4 py-2">{{ $campaign->sent_emails }}</td>
                    <td class="px-4 py-2">{{ $campaign->failed_emails }}</td>
                    <td class="px-4 py-2">{{ $campaign->total_emails }}</td>
                    <td class="px-4 py-2">{{ ucfirst($campaign->status) }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('reports.show', $campaign) }}" class="text-blue-600 hover:underline">Ver detalle</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection