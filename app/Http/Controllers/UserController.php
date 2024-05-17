<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('resources.views.user.home_page.main');
    }

    // public function secondPage()
    // {
    //     return view('second-page'); // maps to resources/views/second-page.blade.php
    // }
}


