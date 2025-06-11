<h1>All images</h1>
<div>
    <a href="{{ route('images.create') }}">Upload image</a>
</div>
<ul>
    @foreach ($media as $item)
        <li>
            <img src="{{ $item->original_url }}" alt="{{ $item->file_name }}" width="320" />
        </li>
    @endforeach
</ul>