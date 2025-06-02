<?php

namespace App\Http\Controllers;

use App\Models\SystemLog;

class LogController extends Controller
{
    public function index()
    {
        $logs = SystemLog::with('user')->latest()->paginate(30);
        return view('logs.index', compact('logs'));
    }
}
