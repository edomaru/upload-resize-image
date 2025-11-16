<x-app>
    <div class="w-2/3 mx-auto">
        <div class="my-7 flex justify-between items-center">
            <h1 class="text-3xl font-bold">Upload images</h1>
            <a href="{{ route('images.index') }}" class="px-4 py-3 bg-white hover:bg-blue-700 text-blue-700 border border-blue-600 hover:text-white rounded-full transition">Back to all images</a>
        </div>
        
        <form action="{{ route('images.store') }}" enctype="multipart/form-data" method="POST" class="bg-white p-6 rounded-xl shadow" id="upload-form">
            @csrf
            <div class="mb-4">
                <label for="images" class="flex items-center justify-between w-full px-4 py-3 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                    <span id="file-name" class="text-gray-500 text-sm truncate">No file chosen</span>
                    <span class="bg-gray-500 text-white hover:bg-gray-600 px-3 py-1 rounded-md transition">Choose file</span>
                </label>
                <input type="file" id="images" class="hidden" onchange="updateFileNames(event)" name="images[]" multiple accept="image/*">
                @error('images')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-between mt-7">
                <div>
                    <div id="message" style="display: none;" class="text-gray-700 mt-2">Uploading...</div>
                </div>
                <div class="space-x-3">
                    <a href="{{ route('images.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Cancel</a>
                    <button type="submit" id="upload-button" class="bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition cursor-pointer px-4 py-2">Upload</button>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            function updateFileNames(event) {
                const files = event.target.files;
                const fileNameSpan = document.getElementById('file-name');

                if (files.length === 0) {
                    fileNameSpan.textContent = "No file chosen";
                } else if (files.length === 1) {
                    fileNameSpan.textContent = files[0].name;
                } else {
                    fileNameSpan.textContent = `${files.length} file(s) chosen`;
                }
            }

            function handleUpload() {
                const uploadForm = document.getElementById('upload-form');
                const message = document.getElementById('message');
                const fileInput = document.getElementById('images');

                message.style.display = 'none';

                uploadForm.addEventListener('submit', async function(event) {
                    event.preventDefault();
                    const files = fileInput.files;

                    if (files.length === 0) {
                        alert('Please select at least one file to upload.');
                        return; // Stop the function right here
                    }

                    const uploadButton = document.getElementById('upload-button');
                    const csrfToken = uploadForm.querySelector('input[name="_token"]').value;

                    let allUploadsSuccessful = true;

                    // UI Feedback: Start
                    uploadButton.disabled = true;
                    message.style.display = 'block';

                    // Core Loop: Upload each file
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        
                        // Create a new FormData for each file.
                        // This is how we send files via fetch.
                        const formData = new FormData();
                        formData.append('image', file); // 'image' is the key our backend will look for

                        try {
                            const response = await fetch(uploadForm.action, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                body: formData,
                            });

                            if (!response.ok) {
                                allUploadsSuccessful = false;
                            }
                        } catch (error) {
                            allUploadsSuccessful = false;
                        }
                    }

                    // UI Feedback: Finish
                    uploadButton.disabled = false;
                    fileInput.value = ''; // Clear the file input
                    message.style.display = 'none';

                    // Final Status
                    if (allUploadsSuccessful) {
                        alert('All files uploaded successfully!');
                    } else {
                        alert('Some files failed to upload.');
                    }
                });
            }

            document.addEventListener('DOMContentLoaded', handleUpload);
        </script>
    @endpush
</x-app>