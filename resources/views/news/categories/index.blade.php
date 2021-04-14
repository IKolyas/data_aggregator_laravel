@section('categories')
    @forelse($categories as $category)
        <div class="list-group">
            <a href="{{ route('categories.show', ['id' => $category->id]) }}"
               class="list-group-item list-group-item-action list-group-item-info my-1
               {{ (request()->is('categories/show/' . $category->id) ? 'active' : '') }}"
            >
                {{ $category->title }} <b>({{$category->news_count}})</b>
            </a>
        </div>
    @empty
    @endforelse
@endsection
