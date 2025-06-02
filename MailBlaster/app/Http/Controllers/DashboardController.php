<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('administrador')) {
            // Datos completos para admin
            $activeCampaigns = \App\Models\Campaign::whereIn('status', ['pending', 'processing', 'active'])->count();
            $sentEmails = \App\Models\Campaign::sum('sent_emails');
            $usersCount = \App\Models\User::where('active', true)->count();
            $adminsCount = \App\Models\User::role('administrador')->where('active', true)->count();
            $publicistasCount = \App\Models\User::role('publicista')->where('active', true)->count();
            $activeTemplates = \App\Models\Template::where('active', true)->count();

            $recentCampaigns = \App\Models\Campaign::latest()->take(3)->get();
            $recentLogs = \App\Models\SystemLog::with('user')->latest()->take(5)->get();
            $recentTemplates = \App\Models\Template::latest()->take(3)->get();

            return view('dashboard.admin', compact(
                'activeCampaigns',
                'sentEmails',
                'usersCount',
                'adminsCount',
                'publicistasCount',
                'recentCampaigns',
                'recentLogs',
                'activeTemplates',
                'recentTemplates'
            ));
        } else {
            // Datos filtrados para publicista
            $myCampaigns = \App\Models\Campaign::where('user_id', $user->id)->latest()->take(3)->get();
            $mySentEmails = \App\Models\Campaign::where('user_id', $user->id)->sum('sent_emails');
            $myActiveCampaigns = \App\Models\Campaign::where('user_id', $user->id)->whereIn('status', ['pending', 'processing', 'active'])->count();
            $activeTemplates = \App\Models\Template::where('active', true)->count();

            return view('dashboard.publicista', compact(
                'myCampaigns',
                'mySentEmails',
                'myActiveCampaigns',
                'activeTemplates'
            ));
        }
    }
}
