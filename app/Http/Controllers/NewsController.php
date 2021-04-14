<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use \Illuminate\Contracts\View\View;

class NewsController extends Controller
{

    public function index(): View
    {
        $categories = Category::list()->withCount('news')->get();
        $newsList = News::list()
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('news.index', [
            'newsList' => $newsList,
            'categories' => $categories,
        ]);
    }

    public function show(int $id): View
    {
        $categories = Category::list()->withCount('news')->get();
        $news = News::findOrFail($id);
        return view('news.show', [
            'news' => $news,
            'categories' => $categories
        ]);
    }
}
