<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Welcome to Dashboard</title>
    <style>
        /* Custom scrollbar styling for better aesthetics */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1; /* slate-300 */
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8; /* slate-400 */
        }
        /* Ensure the body takes full viewport height */
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Specific ratio for the image container */
        .aspect-square {
            aspect-ratio: 1 / 1;
        }
    </style>
    @yield('styles')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body>
    <div class="bg-gray-50 antialiased flex flex-col h-screen">
        <!-- 1. NAVBAR (Full Width, Fixed Height) -->
        <nav class="bg-white shadow-md h-16 flex items-center justify-between px-6 z-10 sticky top-0">
            <!-- Left: App Name -->
            <div class="text-xl font-bold text-indigo-600 tracking-wider">
                Mock Insta App
            </div>

            <!-- Right: Profile Dropdown -->
            <div class="relative">
                <button id="profile-menu-button" class="flex items-center space-x-3 focus:outline-none rounded-full transition duration-150 ease-in-out">
                    <span class="text-sm font-medium text-gray-700 hidden sm:block">John Doe</span>
                    <img class="h-10 w-10 rounded-full object-cover border-2 border-indigo-400 hover:border-indigo-600 transition duration-150 ease-in-out"
                        src="https://placehold.co/40x40/6366f1/ffffff?text=JD"
                        alt="User Avatar"
                    >
                </button>

                <!-- Dropdown Menu -->
                <div id="profile-menu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-1 hidden origin-top-right ring-1 ring-black ring-opacity-5 focus:outline-none transition ease-out duration-200 transform">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-md mx-1 my-1">
                        Profile
                    </a>
                    <div class="border-t border-gray-100 my-1"></div>
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-md mx-1 my-1">
                        Logout
                    </a>
                </div>
            </div>
        </nav>

        <!-- 2. MAIN LAYOUT AREA (Sidebar + Content) -->
        <!-- flex-1 ensures this area takes up all remaining vertical space -->
        <div class="flex flex-1 overflow-hidden">

            <!-- 2A. SIDEBAR (Fixed Width, Full Remaining Height) -->
            <!-- custom-scrollbar class allows vertical scrolling if content is long -->
            <aside class="w-64 bg-gray-800 text-white flex-shrink-0 custom-scrollbar overflow-y-auto hidden md:block">
                <div class="p-4 space-y-2">
                    <!-- Sidebar Title/Branding Space -->
                    <div class="text-xs font-semibold uppercase text-gray-400 mb-4 px-2 pt-2">
                        Navigation
                    </div>

                    <!-- Home Button -->
                    <a href="#" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-white bg-indigo-600 shadow-md transition duration-150 ease-in-out hover:bg-indigo-700">
                        <!-- Icon for Home (Lucide icon simulation using inline SVG) -->
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Home
                    </a>

                    <!-- Create Button (Triggers Modal) -->
                    <a id="create-post-button" href="#" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 hover:text-white">
                        <!-- Plus Icon -->
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Create
                    </a>
                </div>
            </aside>

            <!-- 2B. CONTENT AREA (Takes Remaining Space, Scrollable) -->
            <main class="flex-1 p-8 custom-scrollbar overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- JavaScript to handle the profile dropdown toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const button = document.getElementById('profile-menu-button');
            const menu = document.getElementById('profile-menu');

            // Function to toggle menu visibility
            const toggleMenu = () => {
                menu.classList.toggle('hidden');
                // Optional: add transition classes for smooth appearance
                if (!menu.classList.contains('hidden')) {
                    menu.classList.add('scale-100', 'opacity-100');
                    menu.classList.remove('scale-95', 'opacity-0');
                } else {
                    menu.classList.add('scale-95', 'opacity-0');
                    menu.classList.remove('scale-100', 'opacity-100');
                }
            };

            // Toggle menu on button click
            button.addEventListener('click', (event) => {
                event.stopPropagation(); // Prevents the document click listener from firing immediately
                toggleMenu();
            });

            // Close menu when clicking outside
            document.addEventListener('click', (event) => {
                if (!menu.classList.contains('hidden') && !menu.contains(event.target) && !button.contains(event.target)) {
                    toggleMenu();
                }
            });
            @stack('scripts')
        });
    </script>
</body>
</html>
