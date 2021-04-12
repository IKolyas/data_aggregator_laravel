<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;
use \Illuminate\Contracts\View\View;

class NewsCategoryController extends Controller
{

    public function index(): View
    {
        //
        $categories = Category::select(['id', 'title', 'is_visible', 'created_at' ,'updated_at'])->paginate(10);
        return view('admin.news.categories.index', ['categories' => $categories]);
    }


    public function create(): View
    {
        //
        return view('admin.news.categories.create');
    }


    public function store(Request $request): RedirectResponse
    {
        //

        $validatedData = $request->validate([
            'title' => ['required', 'string', 'min:3', 'unique:categories'],
            'is_visible' => ['bool']
        ]);
        $allowFields = $request->only('title', 'is_visible');
        $category = Category::create($allowFields);

        if ($category) {
            return redirect()->route('admin.categories.index')->with('success', 'Категория успешно добавлена!');
        }
        return back()->with('error', 'Произошла ошибка при добавлении категории!');
    }


    public function show(int $id)
    {
        //
    }


    public function edit(Category $category): View
    {

        return view('admin.news.categories.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'min:3'],
            'is_visible' => ['bool']
        ]);
        if (!$request->input('is_visible')) {
            $request->request->add(['is_visible' => 0]);
        }
        $allowFields = $request->only('title', 'is_visible');
        $category = $category->fill($allowFields)->save();
        if ($category) {
            return redirect()->route('admin.categories.index')->with('success', 'Изменения успешно приняты!');
        }
        return back()->with('error', 'Произошла ошибка при изменении категории!');
    }

    public function destroy(int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
            try {
                $category->delete();
                return redirect()->route('admin.categories.index')->with('access', 'Категория успешно удалена!');
            } catch (\Exception $e) {
                return back()->with('error', 'Произошла ошибка при удалении элемента!');
            }
    }
}
