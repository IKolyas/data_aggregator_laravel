<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategory;
use App\Http\Requests\UpdateCategory;
use App\Models\Category;
use \Illuminate\Http\RedirectResponse;
use \Illuminate\Contracts\View\View;

class NewsCategoryController extends Controller
{

    public function index(): View
    {
        $categories = Category::list(true)->orderBy('title')->paginate(10);
        return view('admin.news.categories.index', ['categories' => $categories]);
    }


    public function create(): View
    {
        return view('admin.news.categories.create');
    }


    public function store(CreateCategory $request): RedirectResponse
    {
        $category = Category::create($request->validated());
        if ($category) {
            return redirect()->route('admin.categories.index')->with('success', __('validation-inline.admin.messages.create.success'));
        }
        return back()->with('error', __('validation-inline.admin.messages.create.error'));
    }


    public function show(int $id)
    {
        //
    }


    public function edit(Category $category): View
    {

        return view('admin.news.categories.edit', ['category' => $category]);
    }


    public function update(UpdateCategory $request, Category $category): RedirectResponse
    {

        $category = $category->fill($request->validated());
        if ($category->save()) {
            return redirect()->route('admin.categories.index')->with('success', __('validation-inline.admin.messages.edit.success'));
        }
        return back()->with('error', __('validation-inline.admin.messages.edit.error'));
    }


    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        $category = Category::findOrFail($id);
        try {
            $category->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success', false]);
        }
    }
}
