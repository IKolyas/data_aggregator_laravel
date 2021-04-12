<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use \Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;

class NewsController extends Controller
{

    public function index(): View
    {
        $newsList = News::with('category')->paginate(10);
        return view('admin.news.index', ['newsList' => $newsList]);
    }

    public function create(): View
    {
        //
        $categories = Category::select(['id', 'title'])->get();
        return view('admin.news.create', [
            'categories' => $categories,
        ]);
    }


    public function store(Request $request): RedirectResponse
    {
        //
        $request->validate([
            'category_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'min:3'],
            'image' => ['string'],
            'description' => ['string', 'min:10'],

        ]);
        $slug = \Str::of(\request()->input('title'))->slug('-');
        $request->request->add(['slug' => $slug]);
        $allowFields = $request->only('category_id', 'title', 'slug', 'image', 'description');
        $news = News::create($allowFields);
        if ($news) {
            return redirect()->route('admin.news.index')->with('success', 'Новость успешно добавлена!');
        }
        return back()->with('error', 'Ошибка при добавлении новости');
    }


    public function show(int $id): View
    {

        $news = News::findOrFail($id);
        return view('admin.news.show', [
            'news' => $news,
        ]);
    }


    public function edit(News $news): View
    {
        $categories = Category::select(['id', 'title'])->get();
        return view('admin.news.edit', [
            'news' => $news,
            'categories' => $categories
        ]);
    }


    public function update(Request $request, News $news): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'min:3'],
            'category_id' => ['required', 'integer'],
            'description' => ['string', 'min:10']
        ]);
        $slug = \Str::of(\request()->input('title'))->slug('-');
        $request->request->add(['slug' => $slug]);
        $allowFields = $request->only('category_id', 'title', 'slug', 'image', 'description');
        $news = $news->fill($allowFields)->save();
        if ($news) {
            return redirect()->route('admin.news.index')->with('success', 'Изменения успешно приняты!');
        }
        return back()->with('error', 'Произошла ошибка при изменении новости!');
    }


    public function destroy(int $id): RedirectResponse
    {
        $news = News::findOrFail($id);
        try {
            $news->delete();
            return redirect()->route('admin.news.index')->with('access', 'Новость успешно удалена!');
        } catch (\Exception $e) {
            return back()->with('error', 'Произошла ошибка при удалении элемента!');
        }
    }
}
