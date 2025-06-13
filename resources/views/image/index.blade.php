<x-app>
    <div class="my-7 flex justify-between items-center">
        <h1 class="text-3xl font-bold">All images</h1>
        <a href="{{ route('images.create') }}" class="px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full transition">Upload image</a>
    </div>
    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
        @foreach ($media as $item)
            <li>
                <img src="{{ $item->original_url }}" alt="{{ $item->file_name }}" width="320" class="h-auto max-w-full rounded-lg" />
            </li>
        @endforeach
    </ul>
</x-app>