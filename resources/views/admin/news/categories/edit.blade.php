@extends('layouts.admin')
@section('content')

    <div class="row flex-column">
        <a class="my-5 text-decoration-none text-gray-500 col-8 offset-2" href="{{ url()->previous() }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> назад</a>
        <h1 class="h3 text-gray-800 col-8 offset-2">Редактирование категории</h1>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <form method="POST" action="{{ route( 'admin.categories.update', ['category' => $category]) }}" class="col-8 offset-2">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="formTitle">Наименование</label>
                <input type="text" class="form-control" id="formTitle" name="title" value="{{ $category->title }}">
            </div>
            <div class="form-group">
                <label for="formIsVisible">Видимость</label>
                <input type="checkbox" id="formIsVisibleTrue" name="is_visible" value="1" @if($category->is_visible === true) checked @endif>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection

