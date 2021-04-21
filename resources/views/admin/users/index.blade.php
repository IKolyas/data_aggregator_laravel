@extends('layouts.admin')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Пользователи</h1>
        <a href="{{ route('admin.users.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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
                <th scope="col">Имя</th>
                <th scope="col">E-mail</th>
                <th scope="col">Номер телефона</th>
                <th scope="col">Дата рождения</th>
                <th scope="col">Админ.</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Дата обновления</th>
                <th scope="col">Инструменты</th>
            </tr>
            </thead>
            <tbody>
            @forelse($userList as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->number_phone }}</td>
                    <td>{{ $user->birth_day }}</td>
                    <td>@if(boolval($user->is_admin)) <i class="fa fa-check text-danger" aria-hidden="true"></i> @endif</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}"><i class="fa fa-pencil text-success" aria-hidden="true"></i></a>
                        <button type="button" class="btn btn-link" onclick="destroyModel('user', {{ $user->id }})"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button>
                    </td>
                </tr>
            @empty
                <td colspan="5" class="table-active">Список новостей пуст ...</td>
            @endforelse
            </tbody>
        </table>
        <div>{{$userList->links()}}</div>
    </div>
@endsection
