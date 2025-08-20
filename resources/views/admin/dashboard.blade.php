@extends('admin.admin')

@section('content')
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-primary text-white flex flex-col p-6 shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center flex items-center justify-center gap-2">
            <i data-feather="book-open"></i> Admin Perpus
        </h2>

        <nav class="flex-1 space-y-2">
            <a href="{{ route('kategori.index') }}" target="mainFrame" class="block px-4 py-2 rounded hover:bg-white/20 transition">
                <i data-feather="layers" class="inline w-4 h-4 mr-2"></i> Kelola Kategori
            </a>
            <a href="{{ route('buku.index') }}" target="mainFrame" class="block px-4 py-2 rounded hover:bg-white/20 transition">
                <i data-feather="book" class="inline w-4 h-4 mr-2"></i> Kelola Buku
            </a>
            <a href="{{ route('admin.index') }}" target="mainFrame" class="block px-4 py-2 rounded hover:bg-white/20 transition">
                <i data-feather="check-circle" class="inline w-4 h-4 mr-2"></i> Validasi Peminjaman
            </a>
            <a href="{{ route('admin.kembali') }}" target="mainFrame" class="block px-4 py-2 rounded hover:bg-white/20 transition">
                <i data-feather="corner-down-left" class="inline w-4 h-4 mr-2"></i> Validasi Pengembalian
            </a>
        </nav>

        <form action="{{ route('logout') }}" method="POST" class="mt-6">
            @csrf
            <button type="submit" class="w-full bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded flex items-center justify-center gap-2 transition">
                <i data-feather="log-out" class="w-4 h-4"></i> Logout
            </button>
        </form>
    </aside>

    <!-- Konten Utama -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow px-6 py-4 flex items-center">
            <h3 class="text-lg font-semibold text-dark flex items-center gap-2">
                <i data-feather="home"></i> Dashboard Admin - E-Perpustakaan
            </h3>
        </header>

        <!-- Iframe sebagai konten dinamis -->
        <main class="flex-1 overflow-hidden">
            <iframe
                name="mainFrame"
                src="{{ route('kategori.index') }}"
                class="w-full h-[calc(100vh-100px)] border-none">
            </iframe>
        </main>
    </div>
</div>
@endsection
