<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::latest()->get();
        return view('reports.index', compact('campaigns'));
    }

    public function show($id)
    {
        $campaign = Campaign::with('recipients')->findOrFail($id);
        return view('reports.show', compact('campaign'));
    }
}
