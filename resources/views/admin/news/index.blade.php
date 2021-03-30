@extends('layouts.admin')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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
                <th scope="col">Инструменты</th>
            </tr>
            </thead>
            <tbody>
            @forelse($newsList as $key => $news)
                <tr>
                    <th scope="row">{{$key}}</th>
                    <td>Category</td>
                    <td>{{$news['title']}}</td>
                    <td>{{now()}}</td>
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
