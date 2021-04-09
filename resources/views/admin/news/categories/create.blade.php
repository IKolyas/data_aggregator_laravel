@extends('layouts.admin')
@section('content')

    <div class="row flex-column">
        <a class="my-5 text-decoration-none text-gray-500 col-8 offset-2" href="{{ url()->previous() }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> назад</a>
        <h1 class="h3 text-gray-800 col-8 offset-2">Добавить категорию</h1>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <form method="post" action="{{ route( 'admin.categories.store' ) }}" class="col-8 offset-2">
            @csrf
            <div class="form-group">
                <label for="formTitle">Наименование</label>
                <input type="text" class="form-control" id="formTitle" name="title" value="{{ old('title') }}"
                       required>
            </div>
            <div class="form-group">
                <label for="formIsVisible">Видимость</label>
                <input type="checkbox" id="formIsVisible" name="is_visible" value="{{ old('is_visible') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>
@endsection
