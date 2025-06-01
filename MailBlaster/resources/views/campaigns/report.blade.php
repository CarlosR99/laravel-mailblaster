@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold mb-4">Reporte de campaña: {{ $campaign->name }}</h1>
    <div class="mb-4">
        <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Enviados: {{ $campaign->sent_emails }}</span>
        <span class="bg-red-100 text-red-800 px-2 py-1 rounded">Fallidos: {{ $campaign->failed_emails }}</span>
        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded">Total: {{ $campaign->total_emails }}</span>
    </div>
    <div class="bg-white rounded shadow p-4 overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Error</th>
                    <th class="px-4 py-2">Enviado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recipients as $recipient)
                <tr>
                    <td class="px-4 py-2">{{ $recipient->email }}</td>
                    <td class="px-4 py-2">
                        @if($recipient->status === 'sent')
                            <span class="text-green-600">Enviado</span>
                        @elseif($recipient->status === 'failed')
                            <span class="text-red-600">Fallido</span>
                        @else
                            <span class="text-gray-600">Pendiente</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $recipient->error_message }}</td>
                    <td class="px-4 py-2">{{ $recipient->sent_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection