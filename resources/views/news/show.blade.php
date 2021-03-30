@extends('layouts.main')
@section('content')
    <h1 class="my-4">{{ $news['title'] }}</h1>
    <div class="card mb-4">
        <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
        <div class="card-body">
            <p class="card-text">{{ $news['description'] }}</p>
        </div>
        <div class="card-footer text-muted">
            {{now()}}
        </div>
    </div>
@endsection
