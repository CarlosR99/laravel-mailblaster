<div class="space-y-4">
    <div>
        <label class="block mb-1 font-semibold">Nombre de la campaña</label>
        <input type="text" name="name" class="w-full rounded border-gray-300" value="{{ old('name', $campaign->name ?? '') }}" required>
    </div>
    <div>
        <label class="block mb-1 font-semibold">Plantilla de correo</label>
        <select name="template_id" id="template_id" class="w-full rounded border-gray-300">
            <option value="">Selecciona una plantilla</option>
            @foreach($templates as $template)
                <option value="{{ $template->id }}">{{ $template->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block mb-1 font-semibold">O subir imagen personalizada</label>
        <input type="file" name="image" accept="image/*" class="w-full rounded border-gray-300">
        <small class="text-gray-500">Opcional. Si sube una imagen, se usará como diseño del correo.</small>
        @if(isset($campaign) && $campaign->image_path)
            <div class="mt-2">
                <span class="text-xs text-gray-500">Imagen actual:</span><br>
                <img src="{{ asset('storage/'.$campaign->image_path) }}" alt="Imagen campaña" class="h-24 rounded border">
            </div>
        @endif
    </div>
    <div>
        <label class="block mb-1 font-semibold">Archivo CSV de destinatarios</label>
        <input type="file" name="recipients_csv" accept=".csv,text/csv" class="w-full rounded border-gray-300" required>
        <small class="text-gray-500">Debe contener una columna con los emails.</small>
    </div>
</div>