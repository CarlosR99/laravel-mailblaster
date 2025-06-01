<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Puedes pasar datos estáticos o reales aquí si quieres
        return view('dashboard.admin');
    }
}
