<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNews;
use App\Http\Requests\UpdateNews;
use App\Models\Category;
use App\Models\News;
use \Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;

class NewsController extends Controller
{

    public function index(): View
    {

        $newsList = News::list(true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.news.index', ['newsList' => $newsList]);
    }


    public function create(): View
    {
        $categories = Category::list(true)->get();
        return view('admin.news.create', [
            'categories' => $categories,
        ]);
    }


    public function store(CreateNews $request): RedirectResponse
    {
        $news = new News($request->validated());
        $category = Category::find($request->validated()['category_id']);
        if ($category->news()->save($news)) {
            return redirect()->route('admin.news.index')->with('success', __('validation-inline.admin.messages.create.success'));
        }
        return back()->with('error', __('validation-inline.admin.messages.create.error'));
    }


    public function show(News $news): View
    {
        $news = News::findOrFail($news->id);

        return view('admin.news.show', [
            'news' => $news,
        ]);
    }


    public function edit(News $news): View
    {
        $categories = Category::list(true)->get();

        return view('admin.news.edit', [
            'news' => $news,
            'categories' => $categories
        ]);
    }


    public function update(UpdateNews $request, News $news): RedirectResponse
    {
        $news = $news->fill($request->validated());
        $category = Category::find($request->validated()['category_id']);

        if ($category->news()->save($news)) {
            return redirect()->route('admin.news.index')->with('success', __('validation-inline.admin.messages.edit.success'));
        }
        return back()->with('error', __('validation-inline.admin.messages.edit.error'));
    }


    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
            $news = News::findOrFail($id);

            try {
                $news->delete();
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['success', false]);
            }
    }
}
