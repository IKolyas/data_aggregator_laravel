<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        //
        $newsList = (new News())->getNews(true);
        return view('admin.news.index', ['newsList' => $newsList]);
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        //
        $categories = (new Category())->getCategories(true);
        return view('admin.news.create', [
            'categories' => $categories,
        ]);
    }


    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        //
        $request->validate([
            'category_id' => ['required', 'string', 'min:3'],
            'title' => ['required', 'string', 'min:3'],
            'description' => ['string', 'min:10'],
        ]);
        $allowFields = $request->only('category_id', 'title', 'description');
        return redirect()->route('admin/news');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        //
        $news = (new News())->getNewsById($id);
        return view('admin.news.show', ['news' => $news]);
    }


    public function edit(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        //
        return view('admin.news.edit', ['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy(int $id)
    {
        //
    }
}
