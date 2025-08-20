@extends('admin.admin')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold text-dark mb-6 flex items-center gap-2">
        <i data-feather="edit"></i> Edit Buku
    </h2>

    <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium text-sm text-gray-700">Judul</label>
            <input type="text" name="judul" value="{{ $buku->judul }}" required
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-primary focus:border-primary">
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Penulis</label>
            <input type="text" name="penulis" value="{{ $buku->penulis }}" required
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-primary focus:border-primary">
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Kategori</label>
            <select name="kategori_id"
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-primary focus:border-primary">
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ $kategori->id == $buku->kategori_id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Stok</label>
            <input type="number" name="stok" value="{{ $buku->stok }}" min="0" required
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-primary focus:border-primary">
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Sinopsis</label>
            <textarea name="sinopsis_buku" rows="4"
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-primary focus:border-primary">{{ $buku->sinopsis_buku }}</textarea>
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Gambar</label>
            <input type="file" name="gambar"
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-primary focus:border-primary">
            @if($buku->gambar)
                <img src="{{ asset('storage/' . $buku->gambar) }}" alt="Gambar Buku" class="mt-2 w-24 h-auto rounded shadow">
            @endif
        </div>

        <button type="submit"
            class="bg-primary text-white px-4 py-2 rounded hover:bg-sky-700 transition-all flex items-center gap-2">
            <i data-feather="save"></i> Update
        </button>
    </form>
</div>
@endsection
