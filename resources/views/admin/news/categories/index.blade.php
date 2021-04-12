@extends('layouts.admin')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Все категории</h1>
        <a href="{{ route('admin.categories.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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
                <th scope="col">Наименование</th>
                <th scope="col">видимость</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Дата обновления</th>
                <th scope="col">Инструменты</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td>{{ $category->title }}</td>
                    <td>@if (boolval($category->is_visible))
                            <i class="fa fa-check text-danger" aria-hidden="true"></i>
                        @else <i class="fa fa-times" aria-hidden="true"></i>
                        @endif
                    </td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>

                        <a href="{{ route('admin.categories.edit', $category) }}"><i class="fa fa-pencil text-success" aria-hidden="true"></i></a>
                        <button type="button" class="btn btn-link" onclick="destroyModel('categories', {{ $category->id }})"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button>
                    </td>
                </tr>
            @empty
                <td colspan="5" class="table-active">Список категорий пуст ...</td>
            @endforelse
            </tbody>
        </table>
        <div>{{$categories->links()}}</div>
    </div>

@endsection
