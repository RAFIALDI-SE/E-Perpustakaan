@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto text-center py-16 px-6">
    <h1 class="text-4xl md:text-5xl font-bold text-dark mb-6">
        Selamat Datang di <span class="text-primary">E-Perpustakaan</span>
    </h1>

    <p class="text-lg text-gray-700 mb-8 leading-relaxed">
        Sistem E-Perpustakaan adalah platform digital yang memudahkan mahasiswa dan pustakawan untuk mengelola peminjaman buku secara efisien dan praktis.
        Anda dapat melihat daftar buku, melakukan peminjaman, serta memantau status pengembalian dengan mudah.
    </p>

    <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="{{ route('login') }}"
           class="bg-primary hover:bg-sky-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300">
            Login
        </a>

        <a href="{{ route('register') }}"
           class="border-2 border-primary text-primary hover:bg-primary hover:text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300">
            Register
        </a>
    </div>
</div>
@endsection
