<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function landing_page() {
        return view('landing_page');
    }

    public function login_page()
    {
        return view('login_page');
    }
}
