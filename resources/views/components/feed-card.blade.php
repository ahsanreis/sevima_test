<div class="bg-white rounded-xl shadow-xl border border-gray-100 max-w-xl mx-auto">

    <!-- Post Header (Profile Bar) -->
    <div class="flex items-center p-4 border-b border-gray-100">
        <img class="h-10 w-10 rounded-full object-cover mr-3 border border-indigo-200"
                src="https://placehold.co/40x40/f87171/ffffff?text=U"
                alt="User Profile"
        >
        <div class="flex flex-col">
            <span class="text-sm font-semibold text-gray-900">{{ $post->user_name }}</span>
            <span class="text-xs text-gray-500">Just now • Featured</span>
        </div>
        <!-- Three dots menu placeholder -->
        <button class="ml-auto text-gray-500 hover:text-gray-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01"></path></svg>
        </button>
    </div>

    <!-- Post Image -->
    <div class="w-full aspect-square bg-gray-200">
        <img class="w-full h-full object-cover"
            src="https://placehold.co/600x600/6366f1/ffffff?text={{ $post->image_test }}"
            alt="Feature Spotlight Image"
        >
    </div>

    <!-- Post Actions & Caption -->
    <div class="p-4">
        <!-- Actions (Like, Comment, Bookmark) -->
        <div class="flex items-center space-x-4 mb-1 text-gray-500">
            <!-- LIKE BUTTON: data-is-liked="false" is the initial state -->
            <button id="like-button-{{ $post->id }}" data-post-id="{{ $post->id }}" data-is-liked="false" class="like-button hover:text-red-500 transition duration-150 cursor-pointer">
                <!-- Heart Icon (initial state: outline) -->
                <svg class="w-6 h-6 heart-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            </button>
            <button class="hover:text-blue-500 transition duration-150 cursor-pointer">
                <!-- Comment Icon -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
            </button>
            <!-- Bookmark/Share placeholder -->
            <button class="ml-auto hover:text-green-500 transition duration-150 cursor-pointer">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
            </button>
        </div>

        <!-- Like Count -->
        <p class="text-sm font-semibold text-gray-900 mb-3">
            Liked by <span id="like-count-{{ $post->id }}">1,234</span> others
        </p>

        <!-- Caption -->
        <p class="text-sm">
            <span class="font-bold text-gray-900 mr-1">{{ $post->user_name }}</span>
            <span class="text-gray-700">
                {{ $post->caption }}
            </span>
        </p>

        <p class="text-xs text-gray-400 mt-2">
            View all 1,234 comments
        </p>
    </div>
</div>
