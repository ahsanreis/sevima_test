@extends('layouts.app')
@section('styles')
    <style>
        .liked-red {
            fill: #ef4444; /* red-500 */
            stroke: #ef4444; /* red-500 */
        }
        #upload-modal {
            transition: opacity 0.3s ease-out;
        }
        #upload-modal > div {
            transition: transform 0.3s ease-out;
        }
    </style>
@endsection
@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Dashboard Feed</h1>
        <!-- Feed Card Component -->
        <div class="space-y-8">
            @for ($i = 0; $i < 3; $i++)
            <x-feed-card :post="$posts[$i]" />
            @endfor
        </div>
    </div>
    <x-modals.create />
@endsection
@pushOnce('scripts')
    document.querySelectorAll('.like-button').forEach(likeButton => {
        const isLiked = likeButton.dataset.isLiked === 'true';
        const heartIcon = likeButton.querySelector('.heart-icon');

        if (isLiked) {
            heartIcon.classList.add('liked-red');
            heartIcon.setAttribute('fill', 'currentColor');
        } else {
            heartIcon.classList.remove('liked-red');
            heartIcon.setAttribute('fill', 'none');
        }

        // Add the click listener
        likeButton.addEventListener('click', async (event) => {
            event.preventDefault();

            const postId = likeButton.dataset.postId;
            let isCurrentlyLiked = likeButton.dataset.isLiked === 'true';
            const likeCountElement = document.getElementById(`like-count-${postId}`);

            // 1. Get CSRF Token (Essential for Laravel POST requests)
            // NOTE: This MUST be replaced in your Blade file with `{{ csrf_token() }}`
            const csrfToken = 'YOUR_LARAVEL_CSRF_TOKEN';

            // 2. Optimistic UI Update
            let currentCount = parseInt(likeCountElement.textContent.replace(/,/g, ''));
            let nextIsLiked = !isCurrentlyLiked;

            const actionUrl = nextIsLiked ? `/posts/${postId}/like` : `/posts/${postId}/unlike`;

            if (nextIsLiked) {
                // LIKE action (Optimistic Update)
                heartIcon.classList.add('liked-red');
                heartIcon.setAttribute('fill', 'currentColor');
                currentCount += 1;
            } else {
                // UNLIKE action (Optimistic Update)
                heartIcon.classList.remove('liked-red');
                heartIcon.setAttribute('fill', 'none');
                currentCount -= 1;
            }

            // Update the displayed count and data attribute immediately
            likeCountElement.textContent = formatNumber(currentCount);
            likeButton.dataset.isLiked = nextIsLiked.toString();
            likeButton.disabled = true; // Prevent double-clicking

            // 3. Send AJAX Request to Laravel
            try {
                const response = await fetch(actionUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                });

                if (!response.ok) {
                    throw new Error('Server error, status: ' + response.status);
                }

                // Success path: UI remains updated

            } catch (error) {
                console.error('Like action failed:', error);
                // 4. Handle Error (Revert UI changes)

                // Revert the state and count back to the original state
                if (isCurrentlyLiked) {
                    heartIcon.classList.add('liked-red');
                    heartIcon.setAttribute('fill', 'currentColor');
                    currentCount += 1;
                } else {
                    heartIcon.classList.remove('liked-red');
                    heartIcon.setAttribute('fill', 'none');
                    currentCount -= 1;
                }

                likeCountElement.textContent = formatNumber(currentCount);
                likeButton.dataset.isLiked = isCurrentlyLiked.toString(); // Revert data attribute

            } finally {
                likeButton.disabled = false;
            }
        });
    });

    // --- CREATE MODAL LOGIC & IMAGE PREVIEW ---
    const modal = document.getElementById('upload-modal');
    const modalContent = modal.querySelector('div');
    const createButton = document.getElementById('create-post-button');
    const closeModalButton = document.getElementById('close-modal-button');

    // New Image Preview Elements
    const imageInput = document.getElementById('image-upload-input');
    const imagePreview = document.getElementById('image-preview');
    const uploadPlaceholder = document.getElementById('upload-placeholder');

    const openModal = () => {
        modal.classList.remove('hidden');
        // Use requestAnimationFrame to ensure CSS applies before transitions start
        requestAnimationFrame(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
        });
    };

    const closeModal = () => {
        modal.classList.add('opacity-0');
        modalContent.classList.add('scale-95');

        // Reset image input and preview state
        imageInput.value = '';
        imagePreview.src = '';
        imagePreview.classList.add('hidden');
        uploadPlaceholder.classList.remove('hidden');

        // Hide fully after the transition completes
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    };

    // Event listener for image selection
    imageInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
                uploadPlaceholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            // If the user opens the dialog and cancels without selecting a file
            imagePreview.src = '';
            imagePreview.classList.add('hidden');
            uploadPlaceholder.classList.remove('hidden');
        }
    });

    // Event Listeners for Modal control
    createButton.addEventListener('click', (event) => {
        event.preventDefault();
        openModal();
    });

    closeModalButton.addEventListener('click', closeModal);

    // Close when clicking directly on the backdrop
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeModal();
        }
    });

    // Close with Escape key
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });

    // AJAX for Upload & Publish on form id create-post-form
    const createPostForm = document.getElementById('create-post-form');
    createPostForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const formData = new FormData(createPostForm);
        console.log('formData:', createPostForm);
        const _token = document.querySelector('input[name="_token"]').value;
        const api_token = document.querySelector('input[name="api_token"]').value;
        console.log('API Token:', api_token, '_token:', _token);

        fetch('/api/posts', {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + api_token,
                'X-CSRF-TOKEN': _token,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Post uploaded successfully:', data);
            closeModal();
        })
        .catch(error => {
            console.error('Error uploading post:', error);
        });
    });

@endPushOnce
