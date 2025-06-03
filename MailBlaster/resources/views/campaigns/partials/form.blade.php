<div class="space-y-6">
    <div>
        <label class="form-label">Nombre de la campaña</label>
        <input type="text" name="name" class="form-input" 
               value="{{ old('name', $campaign->name ?? '') }}" 
               placeholder="Ej: Campaña de Verano 2024" required>
    </div>
    
    <div>
        <label class="form-label">Plantilla de correo</label>
        <select name="template_id" id="template_id" class="form-select">
            <option value="">Selecciona una plantilla</option>
            @foreach($templates as $template)
                <option value="{{ $template->id }}" 
                    {{ old('template_id', $campaign->template_id ?? '') == $template->id ? 'selected' : '' }}>
                    {{ $template->name }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div>
        <label class="form-label">Imagen personalizada</label>
        <input type="file" id="image-upload" accept="image/*" class="file-upload">
        <input type="hidden" name="image_path" id="image-path" value="{{ old('image_path', $campaign->image_path ?? '') }}">
        <p class="text-sm text-slate-500 mt-1">Opcional. Reemplaza la imagen de la plantilla</p>
        <img id="preview-image"
             src="{{ old('image_path') ? asset('storage/' . old('image_path')) : (isset($campaign) && $campaign->image_path ? asset('storage/' . $campaign->image_path) : '') }}"
             class="h-20 rounded-lg border border-slate-200 mt-2 {{ old('image_path') || (isset($campaign) && $campaign->image_path) ? '' : 'hidden' }}"
             alt="Vista previa">
        @if(isset($campaign) && $campaign->image_path)
            <div class="mt-4 flex items-center">
                <div class="ml-4">
                    <p class="text-sm text-slate-700">Imagen actual</p>
                    <p class="text-xs text-slate-500 mt-1">{{ basename($campaign->image_path) }}</p>
                </div>
            </div>
        @endif
    </div>
    
    <div>
        <label class="form-label">Destinatarios (CSV)</label>
        <input type="file" name="recipients_csv" accept=".csv,text/csv" class="file-upload" 
               {{ isset($campaign) ? '' : 'required' }}>
        <p class="text-sm text-slate-500 mt-1">
            Archivo CSV con columna "email". 
            @if(isset($campaign))
                <span class="text-amber-600">Dejar vacío para mantener los actuales</span>
            @endif
        </p>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('image-upload').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const form = new FormData();
    form.append('attachment', file);

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
            // Guarda la URL absoluta, no el path relativo
            document.getElementById('image-path').value = result.file.url;
            document.getElementById('preview-image').src = result.file.url;
            document.getElementById('preview-image').classList.remove('hidden');
        } else {
            alert("Error subiendo la imagen");
        }
    })
    .catch(error => {
        alert("Error subiendo la imagen");
    });
});
</script>
@endpush