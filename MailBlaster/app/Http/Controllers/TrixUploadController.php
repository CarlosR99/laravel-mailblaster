<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrixUploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('attachment')) {
            $folder = $request->input('folder', 'trix_images'); // Por defecto plantillas
            $path = $request->file('attachment')->store($folder, 'public');
            return [
                'success' => 1,
                'file' => [
                    'url' => asset('storage/' . $path),
                    'path' => $path
                ]
            ];
        }
        return ['success' => 0];
    }
}
