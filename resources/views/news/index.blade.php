@extends('layouts.main')
@section('content')
    <h1 class="my-4">Лента новостей
    </h1>
    @forelse($newsList as $key => $news)
    <div class="card mb-4">
        <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
        <div class="card-body">
            <h2 class="card-title">{{ $news['title'] }}</h2>
            <p class="card-text">{{ substr($news['description'], 0, 100) . '...' }}</p>
            <a href='{{ route('news.show', ['id' => $key]) }}' class="btn btn-primary">читать дальше &rarr;</a>
        </div>
        <div class="card-footer text-muted">
            {{now()}}
        </div>
    </div>
    @empty
        <h2>Список новостей пуст</h2>
    @endforelse
@endsection
