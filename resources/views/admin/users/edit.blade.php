@extends('layouts.admin')
@section('content')

    <div class="row flex-column">
        <a class="my-5 text-decoration-none text-gray-500 col-8 offset-2" href="{{ url()->previous() }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> назад</a>
        <h1 class="h3 text-gray-800 col-8 offset-2">Редактировать профиль пользователя</h1>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <form method="post" action="{{ route( 'admin.users.update', ['user' => $user] ) }}" class="col-8 offset-2">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="formName">Имя</label>
                <input type="text" class="form-control" id="formName" name="name" value="{{ $user->name }}"
                       required>
            </div>
            <div class="form-group">
                <label for="formEmail">E-mail</label>
                <input type="email" class="form-control" id="formEmail" name="email" value="{{ $user->email }}"
                       required>
            </div>
            <div class="form-group">
                <label for="formIsAdmin">Права администратора</label>
                <input type="checkbox" id="formIsAdmin" name="is_admin" value="1" @if($user->is_admin === true) checked @endif>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
