@extends('layouts.main')
@section('content')
    <h1 class="my-4">Лента новостей
    </h1>
    @forelse($newsList as $news)
        <div class="card mb-4">
            @if (!is_null($news->image))
                <img class="card-img-top" src="{{ $news->image  }}" alt="Card image cap">
            @endif
            <div class="card-body">
                <h2 class="card-title">{{ $news->title }}</h2>
                <p class="card-text">{{ substr($news->description, 0, 100) . '...' }}</p>
                <a href='{{ route('news.show', ['id' => $news->id]) }}' class="btn btn-primary">читать дальше &rarr;</a>
            </div>
            <div class="card-footer text-muted">
                <span>Дата добавления: {{ $news->created_at }}</span>
                <span class="mx-2">Категория: {{ $news->category_title }}</span>
            </div>
        </div>
    @empty
        <h2>Список новостей пуст</h2>
    @endforelse
@endsection
@section('categories')
    @forelse($categories as $category)
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action list-group-item-info my-1">{{ $category->title }}</a>
        </div>
    @empty
    @endforelse
@endsection
