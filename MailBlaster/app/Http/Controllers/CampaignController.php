<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\EmailRecipient;
use Illuminate\Http\Request;
use App\Imports\RecipientsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CampaignLog;
use App\Models\SystemLog;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::with('template')->get();
        return view('campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        $templates = \App\Models\Template::where('active', true)->get();
        return view('campaigns.create', compact('templates'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'recipients_csv' => 'required|file|mimes:csv,txt',
            'template_id' => 'nullable|exists:templates,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if (!$request->template_id && !$request->hasFile('image')) {
            return back()->withErrors(['template_id' => 'Debe seleccionar una plantilla o subir una imagen.'])->withInput();
        }

        $imagePath = null;
        $templateId = $request->template_id;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('campaign_images', 'public');
            $templateId = null;
        }

        // Crear campaña
        $campaign = Campaign::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'template_id' => $templateId,
            'image_path' => $imagePath,
            'status' => 'pending',
        ]);

        // Procesar CSV con Laravel Excel
        $import = new RecipientsImport();
        Excel::import($import, $request->file('recipients_csv'));

        if (count($import->emails) === 0) {
            $campaign->delete();
            return back()->withErrors(['recipients_csv' => 'El archivo no contiene emails válidos.']);
        }

        // Guardar destinatarios únicos
        foreach ($import->emails as $email) {
            EmailRecipient::create([
                'campaign_id' => $campaign->id,
                'email' => $email,
            ]);
        }

        $campaign->total_emails = count($import->emails);
        $campaign->status = 'processing';
        $campaign->save();

        // Despachar jobs para envío masivo
        foreach ($campaign->recipients as $recipient) {
            \App\Jobs\SendCampaignEmailJob::dispatch($campaign, $recipient);
        }

        SystemLog::create([
            'user_id' => auth()->id(),
            'entity_type' => 'campaign',
            'entity_id' => $campaign->id,
            'action' => 'created',
            'description' => 'Campaña creada: ' . $campaign->name,
        ]);

        return redirect()->route('campaigns.index')->with('success', 'Campaña creada y envío iniciado.');
    }

    public function report(Campaign $campaign)
    {
        $recipients = $campaign->recipients;
        return view('campaigns.report', compact('campaign', 'recipients'));
    }

    public function edit(Campaign $campaign)
    {
        return view('campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'template' => 'required|in:plantilla1,plantilla2',
            'image' => 'nullable|image|max:2048',
        ]);

        // Si sube nueva imagen, reemplaza la anterior
        if ($request->hasFile('image')) {
            if ($campaign->image_path) {
                \Storage::disk('public')->delete($campaign->image_path);
            }
            $campaign->image_path = $request->file('image')->store('campaign_images', 'public');
        }

        $campaign->update([
            'name' => $validated['name'],
            'template' => $validated['template'],
            'image_path' => $campaign->image_path,
        ]);

        SystemLog::create([
            'user_id' => auth()->id(),
            'entity_type' => 'campaign',
            'entity_id' => $campaign->id,
            'action' => 'updated',
            'description' => 'Campaña actualizada: ' . $campaign->name,
        ]);

        return redirect()->route('campaigns.index')->with('success', 'Campaña actualizada correctamente.');
    }

    public function destroy(Campaign $campaign)
    {
        // Deshabilitar campaña
        $campaign->status = 'disabled';
        $campaign->save();

        SystemLog::create([
            'user_id' => auth()->id(),
            'entity_type' => 'campaign',
            'entity_id' => $campaign->id,
            'action' => 'disabled',
            'description' => 'Campaña deshabilitada: ' . $campaign->name,
        ]);

        return redirect()->route('campaigns.index')->with('success', 'Campaña deshabilitada correctamente.');
    }
}