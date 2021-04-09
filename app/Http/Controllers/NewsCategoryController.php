<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
    //
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $categories = (new Category())->getCategories();
        return view('news.index', ['categories' => $categories]);
    }
}
