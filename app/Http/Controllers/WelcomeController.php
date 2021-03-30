<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function index(): string
    {
        return "<h2>Страница приветствия</h2>";
    }
}
