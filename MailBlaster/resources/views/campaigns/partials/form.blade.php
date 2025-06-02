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
        <input type="file" name="image" accept="image/*" class="file-upload">
        <p class="text-sm text-slate-500 mt-1">Opcional. Reemplaza la imagen de la plantilla</p>
        
        @if(isset($campaign) && $campaign->image_path)
            <div class="mt-4 flex items-center">
                <img src="{{ asset('storage/'.$campaign->image_path) }}" 
                     alt="Imagen campaña" 
                     class="h-20 rounded-lg border border-slate-200">
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