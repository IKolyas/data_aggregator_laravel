<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;

class NewsController extends Controller
{
    //

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $categories = (new Category())->getCategories();
        $newsList = (new News())->getNews();
        return view('news.index', [
            'newsList' => $newsList,
            'categories' => $categories
            ]);
    }
    public function show(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $news = (new News())->getNewsById($id);
        return view('news.show', ['news' => $news]);
    }
}
