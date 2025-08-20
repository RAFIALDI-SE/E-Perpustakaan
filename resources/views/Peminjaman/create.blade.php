@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-dark mb-6">📖 Form Peminjaman Buku</h2>

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-6">
        <h3 class="text-lg font-semibold text-primary mb-2">{{ $buku->judul }}</h3>
        <p class="text-sm text-gray-700 leading-relaxed">
            <strong>Penulis:</strong> {{ $buku->penulis }}<br>
            <strong>Kategori:</strong> {{ $buku->kategori->nama_kategori }}<br>
            <strong>Stok Tersedia:</strong> {{ $buku->stok }}<br>
            <strong>Sinopsis:</strong><br> {{ $buku->sinopsis_buku }}
        </p>
    </div>

    <form action="{{ route('peminjaman.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="buku_id" value="{{ $buku->id }}">

        <div>
            <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" required
                   min="{{ now()->addDay()->toDateString() }}"
                   class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('peminjaman.index') }}"
               class="inline-block px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md transition">← Kembali</a>
            <button type="submit"
                    class="px-6 py-2 bg-primary text-white font-semibold rounded-md hover:bg-blue-600 transition">
                📥 Ajukan Peminjaman
            </button>
        </div>
    </form>
</div>
@endsection
