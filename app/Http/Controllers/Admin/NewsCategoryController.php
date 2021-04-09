<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        //
        $categories = (new Category())-> getCategories(true);
        return view('admin.news.categories.index', ['categories' => $categories]);
    }


    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        //
        return view('admin.news.categories.create');
    }


    public function store(Request $request)
    {
        //

        $request->validate([
            'title' => ['required', 'string', 'min:3'],
            'is_visible' => ['required', 'bool'],
        ]);
        $allowFields = $request->only('title', 'is_visible');
        return redirect()->route('admin/categories');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
        return "<h2>Редактирование категорий</h2>";
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
