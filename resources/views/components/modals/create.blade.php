<div id="upload-modal" class="fixed inset-0 bg-black bg-black/75 flex items-center justify-center z-50 hidden opacity-0">
    <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-sm relative transform scale-95">

        <!-- Close Button -->
        <button id="close-modal-button" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 p-1 rounded-full hover:bg-gray-100 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <h2 class="text-xl font-bold text-gray-900 mb-6 text-center">Create New Post</h2>
        <form id="create-post-form">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="api_token" value="{{ Cookie::get('api_token') }}">
            <!-- Image Upload Content -->
            <div class="relative flex flex-col items-center justify-center p-8 border-2 border-dashed border-gray-300 rounded-xl hover:border-blue-400 transition cursor-pointer group h-48">
                <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden" src="" alt="Image Preview">

                <!-- Placeholder content (hidden when image is selected) -->
                <div id="upload-placeholder" class="text-center">
                    <svg class="w-12 h-12 text-gray-400 mb-3 group-hover:text-blue-500 transition mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-12 5h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <p class="text-blue-600 font-semibold text-lg">Select your image</p>
                    <p class="text-sm text-gray-500 mt-1">PNG, JPG, or GIF (max 10MB)</p>
                </div>
                <!-- Actual file input hidden and placed over the whole area -->
                <input type="file" name="image" id="image-upload-input" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
            </div>

            <!-- New Caption Field -->
            <div class="mt-4">
                <label for="post-caption" class="block text-sm font-medium text-gray-700 mb-1">Caption</label>
                <textarea
                    name="caption"
                    id="post-caption"
                    rows="3"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition resize-none shadow-sm"
                    placeholder="Write a caption..."
                ></textarea>
            </div>
            <!-- End New Caption Field -->

            <!-- Optional: submit button -->
            <button type="submit" id="publish-button" class="w-full mt-6 bg-blue-600 text-white py-2 cursor-pointer rounded-lg font-semibold hover:bg-blue-800 transition duration-150 shadow-md">
                Upload & Publish
            </button>
        </form>
    </div>
</div>
