@extends('admin.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4 text-dark">Daftar Buku</h2>

    <a href="{{ route('buku.create') }}" class="inline-block mb-4 bg-primary hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
        + Tambah Buku
    </a>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-700 border border-gray-200">
            <thead class="bg-gray-100 text-gray-800">
                <tr>
                    <th class="px-4 py-2 border">Judul</th>
                    <th class="px-4 py-2 border">Penulis</th>
                    <th class="px-4 py-2 border">Kategori</th>
                    <th class="px-4 py-2 border">Stok</th>
                    <th class="px-4 py-2 border">Admin</th>
                    <th class="px-4 py-2 border">Gambar</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bukus as $buku)
                    <tr class="bg-white hover:bg-gray-50 border-t">
                        <td class="px-4 py-2 border">{{ $buku->judul }}</td>
                        <td class="px-4 py-2 border">{{ $buku->penulis }}</td>
                        <td class="px-4 py-2 border">{{ $buku->kategori->nama_kategori }}</td>
                        <td class="px-4 py-2 border">{{ $buku->stok }}</td>
                        <td class="px-4 py-2 border">{{ $buku->user->nama ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border">
                            @if($buku->gambar)
                                <img src="{{ asset('storage/' . $buku->gambar) }}" alt="Gambar Buku" class="w-20 rounded shadow">
                            @else
                                <span class="text-gray-400 text-sm italic">Tidak ada</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border space-x-2">
                            <a href="{{ route('buku.edit', $buku->id) }}" class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                Edit
                            </a>
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-block bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
