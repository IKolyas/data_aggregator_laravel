@extends('layouts.main')
@section('content')
    <h1 class="my-4">{{ $news->title }}</h1>
    <div class="card mb-4">
        @if (!is_null($news->image))
            <img class="card-img-top" src="{{ $news->image  }}" alt="Card image cap">
        @endif
        <div class="card-body">
            <p class="card-text">{{ $news->description }}</p>
        </div>
        <div class="card-footer text-muted">
            <span>Дата добавления: {{ $news->created_at }}</span>
            <span class="mx-2">Категория: {{ $news->category_title }}</span>
        </div>
    </div>
@endsection
