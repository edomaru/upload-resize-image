<x-app>
    <div class="w-2/3 mx-auto">
        <div class="my-7 flex justify-between items-center">
            <h1 class="text-3xl font-bold">Upload images</h1>
            <a href="{{ route('images.create') }}" class="px-4 py-3 bg-white hover:bg-blue-700 text-blue-700 border border-blue-600 hover:text-white rounded-full transition">Back to all images</a>
        </div>
        
        <form action="{{ route('images.store') }}" enctype="multipart/form-data" method="POST" class="bg-white p-6 rounded-xl shadow">
            @csrf
            <div class="mb-4">
                <label for="images" class="block text-gray-700 font-medium mb-2">Choose images</label>
                <input type="file" id="images" name="images[]" multiple accept="image/*">
                @error('images')
                    <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex justify-end space-x-3 mt-7">
                <a href="{{ route('images.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Cancel</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition cursor-pointer px-4 py-2">Upload</button>
            </div>
        </form>
    </div>
</x-app>