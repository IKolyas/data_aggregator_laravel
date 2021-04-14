@extends('layouts.admin')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Все новости</h1>
        <a href="{{ route('admin.news.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Добавить </a>
    </div>

    <div class="row">
        @if (session()->has('success'))
            <div class="alert alert-success"> {{session()->get('success')}} </div>
        @endif
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Категория</th>
                <th scope="col">Тема</th>
                <th scope="col">Слаг</th>
                <th scope="col">Путь к картинке</th>
                <th scope="col">Картинка</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Дата обновления</th>
                <th scope="col">Инструменты</th>
            </tr>
            </thead>
            <tbody>
            @forelse($newsList as $news)
                <tr>
                    <th scope="row">{{$news->id}}</th>
                    <td>{{ $news->category->title }}</td>
                    <td>
                        <a href="{{ route('admin.news.show', ['news' => $news]) }}"> {{ $news->title }} </a>
                    </td>
                    <td>{{ $news->slug }}</td>
                    <td>{{ $news->image }}</td>
                    <td>
                        <div class="text-center">
                            <img src="{{$news->image}}" class="rounded" width="100" height="100" alt="{{ $news->title }}">
                        </div>
                    </td>
                    <td>{{ $news->created_at }}</td>
                    <td>{{ $news->updated_at }}</td>
                    <td>
                    <td>
                        <a href="{{ route('admin.news.edit', $news) }}"><i class="fa fa-pencil text-success" aria-hidden="true"></i></a>
                        <button type="button" class="btn btn-link" onclick="destroyModel('news', {{ $news->id }})"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button>
                    </td>
                    </td>
                </tr>
            @empty
                <td colspan="5" class="table-active">Список новостей пуст ...</td>
            @endforelse
            </tbody>
        </table>
            <div>{{$newsList->links()}}</div>
    </div>
@endsection
