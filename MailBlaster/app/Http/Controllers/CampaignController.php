<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\EmailRecipient;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::latest()->get();
        return view('campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('campaigns.create');
    }

    public function store(Request $request)
    {
        // Validación y lógica para crear campaña y cargar CSV
    }

    public function report(Campaign $campaign)
    {
        $recipients = $campaign->recipients;
        return view('campaigns.report', compact('campaign', 'recipients'));
    }
}