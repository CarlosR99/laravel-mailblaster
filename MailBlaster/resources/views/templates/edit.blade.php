@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold mb-4">Editar plantilla</h1>
    <div class="bg-white rounded shadow p-4">
        <form action="{{ route('templates.update', $template) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block mb-1 font-semibold">Nombre</label>
                <input id="name" type="text" name="name" class="w-full rounded border-gray-300" value="{{ old('name', $template->name) }}" required>
            </div>
            <div class="mb-4">
                <label for="subject" class="block mb-1 font-semibold">Asunto (opcional)</label>
                <input id="subject" type="text" name="subject" class="w-full rounded border-gray-300" value="{{ old('subject', $template->subject) }}">
            </div>
            <div class="mb-4">
                <label for="content" class="block mb-1 font-semibold">Contenido</label>
                <input id="content" type="hidden" name="content" value="{{ old('content', $template->content) }}">
                <trix-editor input="content"></trix-editor>
                <small class="text-gray-500">
                    Escribe el contenido del correo. Puedes usar negritas, listas, enlaces e imágenes.<br>
                    Si pegas imágenes, asegúrate que sean accesibles para los destinatarios.
                </small>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar plantilla</button>
            </div>
        </form>
    </div>
@endsection

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