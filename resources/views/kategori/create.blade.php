@extends('admin.admin')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-dark mb-6 flex items-center gap-2">
        <i data-feather="plus-square"></i> Tambah Kategori
    </h2>

    <form action="{{ route('kategori.store') }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
        @csrf

        <div>
            <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" required
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-primary focus:border-primary" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="bg-primary text-white px-4 py-2 rounded hover:bg-sky-700 transition-all">
                <i data-feather="save" class="inline w-4 h-4 mr-1"></i> Simpan
            </button>

            <a href="{{ route('kategori.index') }}"
                class="text-primary hover:underline flex items-center">
                <i data-feather="arrow-left" class="inline w-4 h-4 mr-1"></i> Kembali
            </a>
        </div>
    </form>
</div>
@endsection
