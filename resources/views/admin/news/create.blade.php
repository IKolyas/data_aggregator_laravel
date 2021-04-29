@extends('layouts.admin')
@section('content')

    <div class="row flex-column">
        <a class="my-5 text-decoration-none text-gray-500 col-8 offset-2" href="{{ url()->previous() }}"><i
                class="fa fa-chevron-left" aria-hidden="true"></i> назад</a>
        <h1 class="h3 text-gray-800 col-8 offset-2">Добавить новость</h1>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <form method="post" action="{{ route( 'admin.news.store' ) }}" class="col-8 offset-2"
              enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="formCategory">Категория</label>
                <select id="formCategory" class="form-control" name="category_id" required>
                    @forelse($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @empty
                        <option selected>нет категорий ...</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group">
                <label for="formTitle">Заголовок(тема) новости</label>
                <input type="text" class="form-control" id="formTitle" name="title" value="{{ old('title') }}"
                       required>
            </div>
            <div class="form-group">
                <label for="formImageLink">Ссылка на картинку</label>
                <input type="text" class="form-control" id="formImageLink" name="image_link"
                       value="{{ old('image_link') }}">
            </div>
            <div class="form-group">
                <input type="file" name="image_path" multiple>
                <img src="{{ old('image_path') }}" alt="{{ old('image_path') }}" class="mx-2">
            </div>
            <div class="form-group" id="editor">
                <label for="formDescription">Текст новости</label>
                <textarea id="description" class="form-control" id="formDescription"
                          name="description"> {{ old('description') }} </textarea>
            </div>
            <div class="form-group">
                <label>Статус</label>
                @forelse(\App\Enums\StatusNews::STATUSES as $status)
                    <div class="form-check">
                        <input class="form-check-input"
                               type="radio"
                               name="status"
                               id="{{ $status }}"
                               value="{{ $status }}"
                               required
                               @if($status == 'editing') checked @endif
                        >

                        <label class="form-check-label" for="{{ $status }}">
                            {{$status}}
                        </label>
                    </div>
                @empty
                    <option selected>нет категорий ...</option>
                @endforelse
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>
@endsection
@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <script>

        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>

@endpush
