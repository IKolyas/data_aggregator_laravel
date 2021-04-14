<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use \Illuminate\Contracts\View\View;

class NewsCategoryController extends Controller
{

    public function index(): View
    {
        $categories = Category::list()->get();
        return view('news.categories.index', ['categories' => $categories]);
    }

    public function show(int $id): View
    {
        $categories = Category::list()->withCount('news')->get();
        $newsList = News::list()->where('category_id', '=', $id)->paginate(5);
        return view('news.index', [
            'newsList' => $newsList,
            'categories' => $categories
        ]);
    }
}
