<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        //
        return view('admin.news.index', ['newsList' => $this->newsList]);
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        //
        return view('admin.news.create', ['categoryList' => $this->categoryList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'newsCategory' => ['required', 'string', 'min:3'],
            'newsTitle' => ['required', 'string', 'min:3'],
            'newsDescription' => ['string', 'min:10'],
            'newsDateCreate' => ['required', 'date'],
        ]);
        $allowFields = $request->except('newsCategory', 'newsTitle', 'newsDescription', 'newsDateCreate');
        return 'Create news - OK!';
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        //
        $news = $this->newsList[$id];
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
