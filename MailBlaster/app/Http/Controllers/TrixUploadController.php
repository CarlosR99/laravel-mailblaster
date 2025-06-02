<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrixUploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('trix_images', 'public');
            return [
                'success' => 1,
                'file' => [
                    'url' => asset('storage/' . $path)
                ]
            ];
        }
        return ['success' => 0];
    }
}
