@extends('admin.admin')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-dark">Daftar Kategori</h2>
        <a href="{{ route('kategori.create') }}" class="bg-primary text-white px-4 py-2 rounded hover:bg-dark">
            + Tambah Kategori
        </a>
    </div>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel kategori --}}
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto text-sm text-left text-gray-700">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nama Kategori</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategoris as $kategori)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $kategori->id }}</td>
                        <td class="px-4 py-2">{{ $kategori->nama_kategori }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('kategori.edit', $kategori->id) }}" class="text-blue-600 hover:underline">
                                Edit
                            </a>
                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-4 text-center text-gray-500">
                            Belum ada kategori tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
