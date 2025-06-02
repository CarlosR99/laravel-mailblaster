<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\SystemLog;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Template::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('name', 'like', "%$q%")
                    ->orWhere('subject', 'like', "%$q%");
            });
        }

        $templates = $query->get();
        return view('templates.index', compact('templates'));
    }

    public function create()
    {
        return view('templates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);
        $template = Template::create($validated);

        SystemLog::create([
            'user_id' => auth()->id(),
            'entity_type' => 'template',
            'entity_id' => $template->id,
            'action' => 'created',
            'description' => 'Plantilla creada: ' . $template->name,
        ]);

        return redirect()->route('templates.index')->with('success', 'Plantilla creada correctamente.');
    }

    public function edit(Template $template)
    {
        return view('templates.edit', compact('template'));
    }

    public function update(Request $request, Template $template)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);
        $template->update($validated);

        SystemLog::create([
            'user_id' => auth()->id(),
            'entity_type' => 'template',
            'entity_id' => $template->id,
            'action' => 'updated',
            'description' => 'Plantilla actualizada: ' . $template->name,
        ]);

        return redirect()->route('templates.index')->with('success', 'Plantilla actualizada correctamente.');
    }

    public function disable(Template $template)
    {
        $template->active = false;
        $template->save();

        SystemLog::create([
            'user_id' => auth()->id(),
            'entity_type' => 'template',
            'entity_id' => $template->id,
            'action' => 'disabled',
            'description' => 'Plantilla deshabilitada: ' . $template->name,
        ]);

        return redirect()->route('templates.index')->with('success', 'Plantilla deshabilitada.');
    }
    public function enable(Template $template)
    {
        $template->active = true;
        $template->save();

        SystemLog::create([
            'user_id' => auth()->id(),
            'entity_type' => 'template',
            'entity_id' => $template->id,
            'action' => 'enabled',
            'description' => 'Plantilla habilitada: ' . $template->name,
        ]);

        return redirect()->route('templates.index')->with('success', 'Plantilla habilitada correctamente.');
    }
}
