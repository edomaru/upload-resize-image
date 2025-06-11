<h1>Upload your images</h1>

<form action="{{ route('images.store') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <input type="file" name="images[]" multiple accept="image/*">
    @error('images')
        <div style="color: red">{{ $message }}</div>
    @enderror
    <button type="submit">Upload</button>
</form>