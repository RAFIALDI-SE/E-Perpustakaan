@extends('admin.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-2xl font-bold text-dark mb-6">Validasi Peminjaman Buku</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if($peminjaman->isEmpty())
        <div class="bg-blue-100 text-blue-800 p-3 rounded">Belum ada data peminjaman.</div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="p-3 text-left">Nama Peminjam</th>
                        <th class="p-3 text-left">Judul Buku</th>
                        <th class="p-3 text-left">Tanggal Pinjam</th>
                        <th class="p-3 text-left">Tanggal Kembali</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Token</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $pinjam)
                    <tr class="border-t">
                        <td class="p-3">{{ $pinjam->user->name }}</td>
                        <td class="p-3">{{ $pinjam->buku->judul }}</td>
                        <td class="p-3">{{ $pinjam->tanggal_pinjam }}</td>
                        <td class="p-3">{{ $pinjam->tanggal_kembali }}</td>
                        <td class="p-3">
                            @if($pinjam->status == 'menunggu')
                                <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded">Menunggu</span>
                            @elseif($pinjam->status == 'dipinjam')
                                <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded">Dipinjam</span>
                            @else
                                <span class="bg-green-200 text-green-800 px-2 py-1 rounded">Dikembalikan</span>
                            @endif
                        </td>
                        <td class="p-3">{{ $pinjam->token }}</td>
                        <td class="p-3">
                            @if($pinjam->status == 'menunggu')
                                <form action="{{ route('admin.peminjaman.validasi', $pinjam->id) }}" method="POST" onsubmit="return confirm('Setujui peminjaman ini?')">
                                    @csrf
                                    <button type="submit" class="bg-primary text-white px-3 py-1 rounded hover:bg-dark">Setujui</button>
                                </form>
                            @else
                                <em class="text-gray-500">-</em>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
