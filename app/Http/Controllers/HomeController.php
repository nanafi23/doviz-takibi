<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        return auth()->check() 
            ? redirect()->route('dashboard')
            : view('welcome');
    }
}