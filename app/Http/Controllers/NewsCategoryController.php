<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
    //
    public function index(): string
    {
        return "<h2>Страница категорий новостей</h2>";
    }
}
