<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * Tableau de bord principal
     */
    public function dashboard()
    {
        return view('dashboard');
    }
}
