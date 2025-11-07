@php
$subButton = ($authTitle == 'login' ? 'Register Here' : 'Back To Login');
@endphp
{{-- Auth Card --}}
<div class="max-w-sm mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-blue-800 text-white">
        <h3 class="text-xl font-semibold text-gray">{{ ucfirst($authTitle) }}</h3>
    </div>

    <div class="px-6 py-4">
        <form method="POST" action="{{ $authTitle == 'login' ? route('login') : route('register') }}">
            @csrf
            @if ($authTitle == 'register')
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                    <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            @endif
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            @if ($authTitle == 'register')
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Password Confirmation:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    @error('password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            @endif
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{ ucfirst($authTitle) }}</button>
                <a href="{{ $authTitle == 'login' ? route('register') : route('login') }}" class="text-blue-500 hover:text-blue-700 text-sm">{{ $subButton }}</a>
            </div>
            @if ($authTitle == 'login')
                <a href="#" class="text-blue-500 hover:text-blue-700 text-sm">Forgot Your Password?</a>
            @endif
        </form>
    </div>
</div>
