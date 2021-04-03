@extends('layouts.admin')
@section('content')

    <div class="row flex-column">
        <a class="my-5 text-decoration-none text-gray-500 col-8 offset-2" href="{{ url()->previous() }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> назад</a>
        <h1 class="h3 text-gray-800 col-8 offset-2">Добавить новость</h1>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <form method="post" action="{{ route( 'admin.news.store' ) }}" class="col-8 offset-2">
            @csrf
            <div class="form-group">
                <label for="formCategory">Категория</label>
                <select id="formCategory" class="form-control" name="newsCategory" required>
                    @forelse($categoryList as $category)
                        <option>{{ $category }}</option>
                    @empty
                        <option selected>нет категорий ...</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group">
                <label for="formTitle">Заголовок(тема) новости</label>
                <input type="text" class="form-control" id="formTitle" name="newsTitle" value="{{ old('newsTitle') }}"
                       required>
            </div>
            <div class="form-group">
                <label for="formDescription">Текст новости</label>
                <input type="text" class="form-control" id="formDescription" name="newsDescription"
                       value="{{ old('newsDescription') }}">
            </div>
            <div class="form-group">
                <label for="formDateCreate">Дата создания</label>
                <input type="date" class="form-control" id="formDateCreate" name="newsDateCreate"
                       value="{{ date("Y-m-d") }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>
@endsection
