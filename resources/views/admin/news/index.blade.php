@extends('layouts.admin')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Все новости</h1>
        <a href="{{ route('admin.news.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Добавить </a>
    </div>

    <div class="row">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Категория</th>
                <th scope="col">Тема</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Дата обновления</th>
                <th scope="col">Инструменты</th>
            </tr>
            </thead>
            <tbody>
            @forelse($newsList as $news)
                <tr>
                    <th scope="row">{{$news->id}}</th>
                    <td>{{ $news->category_title }}</td>
                    <td>
                        <a href="{{ route('admin.news.show', $news->id) }}"> {{ $news->title }} </a>
                    </td>
                    <td>{{ $news->created_at }}</td>
                    <td>{{ $news->updated_at }}</td>
                    <td>
                        <a href="#">
                            Редактировать
                        </a>
                        &nbsp;
                        <a href="#">
                            Удалить
                        </a></td>
                </tr>
            @empty
                <td colspan="5" class="table-active">Список новостей пуст ...</td>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
