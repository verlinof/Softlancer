<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('resources.views.admin.dashboard_admin');
    }

    // public function secondPage()
    // {
    //     return view('second-page'); // maps to resources/views/second-page.blade.php
    // }
}

