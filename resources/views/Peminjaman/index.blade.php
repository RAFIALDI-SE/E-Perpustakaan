@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">


    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 text-green-800 border border-green-300 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 px-4 py-3 bg-red-100 text-red-800 border border-red-300 rounded shadow">
            {{ session('error') }}
        </div>
    @endif


    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <h2 class="text-xl font-semibold text-dark">Daftar Buku Tersedia</h2>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Logout</button>
        </form>
    </div>

    <div class="flex flex-col lg:flex-row gap-6">

        <div class="lg:w-1/4">
            <form method="GET" action="{{ route('peminjaman.index') }}" class="bg-white p-4 rounded shadow">
                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Filter Kategori</label>
                <select name="kategori_id" id="kategori" class="w-full border-gray-300 rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>


        <div class="lg:w-3/4">

            <form method="GET" action="{{ route('peminjaman.index') }}" class="mb-4">
                <div class="flex">
                    <input type="text" name="search" class="flex-grow border border-gray-300 rounded-l px-4 py-2" placeholder="Cari judul buku..." value="{{ request('search') }}">
                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded-r">Cari</button>
                </div>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse($bukus as $buku)
                <div class="bg-white rounded shadow overflow-hidden hover:shadow-lg transition">
                    @if($buku->gambar)
                        <img src="{{ asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul }}" class="h-48 w-full object-cover">
                    @endif
                    <div class="p-4">
                        <h5 class="font-semibold text-lg text-dark">{{ $buku->judul }}</h5>
                        <p class="text-sm text-gray-600 mt-1">
                            <strong>Penulis:</strong> {{ $buku->penulis }}<br>
                            <strong>Kategori:</strong> {{ $buku->kategori->nama_kategori }}<br>
                            <strong>Stok:</strong> {{ $buku->stok }}
                        </p>
                        <a href="{{ route('peminjaman.create', ['buku_id' => $buku->id]) }}" class="mt-3 inline-block w-full text-center bg-primary text-white px-4 py-2 rounded hover:bg-blue-600">Pinjam Buku</a>
                    </div>
                </div>
                @empty
                    <p class="text-gray-500">Tidak ada buku ditemukan.</p>
                @endforelse
            </div>
        </div>
    </div>

    <hr class="my-10">


    <h3 class="text-xl font-semibold text-dark mb-4">Riwayat Peminjaman Saya</h3>
    <div class="overflow-x-auto">
        <table class="w-full table-auto border border-collapse text-sm">
            <thead class="bg-light border">
                <tr class="text-left">
                    <th class="px-3 py-2">Judul Buku</th>
                    <th class="px-3 py-2">Tanggal Pinjam</th>
                    <th class="px-3 py-2">Tanggal Kembali</th>
                    <th class="px-3 py-2">Status</th>
                    <th class="px-3 py-2">Token</th>
                    <th class="px-3 py-2">Denda</th>
                    {{-- <th class="px-3 py-2">Aksi</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamanSaya as $pinjam)
                    @php
                        $denda = 0;
                        if ($pinjam->status !== 'dikembalikan' && \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($pinjam->tanggal_kembali))) {
                            $denda = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($pinjam->tanggal_kembali)) * 1000;
                        }
                    @endphp
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-3 py-2">{{ $pinjam->buku->judul }}</td>
                        <td class="px-3 py-2">{{ $pinjam->tanggal_pinjam }}</td>
                        <td class="px-3 py-2">{{ $pinjam->tanggal_kembali }}</td>
                        <td class="px-3 py-2">
                            <span class="inline-block px-2 py-1 text-xs rounded-full
                                {{ $pinjam->status === 'dipinjam' ? 'bg-yellow-200 text-yellow-800' :
                                   ($pinjam->status === 'menunggu' ? 'bg-gray-200 text-gray-800' : 'bg-green-200 text-green-800') }}">
                                {{ ucfirst($pinjam->status) }}
                            </span>
                        </td>
                        <td class="px-3 py-2">{{ $pinjam->token }}</td>
                        <td class="px-3 py-2">Rp{{ number_format($denda, 0, ',', '.') }}</td>
                        {{-- <td class="px-3 py-2">
                            @if($pinjam->status === 'dipinjam')
                                <form action="{{ route('peminjaman.kembalikan', $pinjam->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-green-600 text-white text-xs px-3 py-1 rounded hover:bg-green-700">Kembalikan</button>
                                </form>
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
