@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center py-10">
    <div class="w-full max-w-md bg-white p-8 shadow-md rounded-lg border border-gray-200">
        <h2 class="text-2xl font-semibold text-center text-dark mb-6">Login</h2>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-sm">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-dark mb-1">Email</label>
                <input type="email" name="email" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-dark mb-1">Password</label>
                <input type="password" name="password" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" required>
            </div>

            <button type="submit" class="w-full bg-primary text-white py-2 rounded hover:bg-sky-600 transition shadow">
                Login
            </button>
        </form>

        <p class="text-center mt-4 text-sm text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-primary hover:underline font-medium">Daftar di sini</a>
        </p>
    </div>
</div>
@endsection
