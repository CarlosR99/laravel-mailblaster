@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Editar Plantilla</h1>
            <p class="text-slate-500 mt-1">{{ $template->name }}</p>
        </div>
        <a href="{{ route('templates.index') }}" class="btn-outline">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver a plantillas
        </a>
    </div>

    <div class="card">
        <form action="{{ route('templates.update', $template) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-5">
                <div>
                    <label class="form-label">Nombre de la plantilla</label>
                    <input type="text" name="name" class="form-input" value="{{ old('name', $template->name) }}" required>
                </div>
                
                <div>
                    <label class="form-label">Asunto del correo (opcional)</label>
                    <input type="text" name="subject" class="form-input" value="{{ old('subject', $template->subject) }}">
                    <p class="text-sm text-slate-500 mt-1">Este será el asunto que verán los destinatarios</p>
                </div>
                
                <div>
                    <label class="form-label">Contenido del correo</label>
                    <input id="content" type="hidden" name="content" value="{{ old('content', $template->content) }}">
                    <div class="template-editor">
                        <trix-editor input="content"></trix-editor>
                    </div>
                    <p class="text-sm text-slate-500 mt-2">
                        Puedes usar negritas, listas, enlaces e imágenes. Si pegas imágenes, asegúrate que sean accesibles para los destinatarios.
                    </p>
                </div>
            </div>
            
            <div class="template-actions">
                <button type="submit" class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Actualizar plantilla
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/trix@2.0.0/dist/trix.umd.min.js"></script>
<script>
document.addEventListener("trix-attachment-add", function(event) {
    if (event.attachment.file) {
        uploadAttachment(event.attachment);
    }
});

function uploadAttachment(attachment) {
    var file = attachment.file;
    var form = new FormData();
    form.append("attachment", file);

    fetch("{{ route('trix.upload') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: form
    })
    .then(response => response.json())
    .then(result => {
        if (result.success && result.file && result.file.url) {
            attachment.setAttributes({
                url: result.file.url,
                href: result.file.url
            });
        }
    })
    .catch(error => {
        console.error("Error uploading image:", error);
    });
}
</script>
@endpush
@endsection