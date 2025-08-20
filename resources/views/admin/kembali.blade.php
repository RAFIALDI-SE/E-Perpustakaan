@extends('admin.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">Konfirmasi Pengembalian Buku</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($peminjaman->isEmpty())
        <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded">
            Tidak ada buku yang sedang dipinjam.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600 border border-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">Nama Peminjam</th>
                        <th class="px-4 py-2 border">Judul Buku</th>
                        <th class="px-4 py-2 border">Tanggal Pinjam</th>
                        <th class="px-4 py-2 border">Tanggal Kembali</th>
                        <th class="px-4 py-2 border">Telat</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Denda</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $pinjam)
                        @php
                            $telat = \Carbon\Carbon::now()->gt($pinjam->tanggal_kembali);
                        @endphp
                        <tr class="bg-white hover:bg-gray-50 border-t">
                            <td class="px-4 py-2 border">{{ $pinjam->user->name }}</td>
                            <td class="px-4 py-2 border">{{ $pinjam->buku->judul }}</td>
                            <td class="px-4 py-2 border">{{ $pinjam->tanggal_pinjam }}</td>
                            <td class="px-4 py-2 border">{{ $pinjam->tanggal_kembali }}</td>
                            <td class="px-4 py-2 border">
                                @if($telat)
                                    <span class="inline-block bg-red-100 text-red-800 px-2 py-1 text-xs rounded">Ya</span>
                                @else
                                    <span class="inline-block bg-green-100 text-green-800 px-2 py-1 text-xs rounded">Tidak</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border capitalize">{{ $pinjam->status }}</td>
                            <td class="px-4 py-2 border">
                                @if($telat)
                                    @php
                                        $hariTelat = \Carbon\Carbon::now()->diffInDays($pinjam->tanggal_kembali);
                                        echo 'Rp ' . number_format($hariTelat * 1000, 0, ',', '.');
                                    @endphp
                                @else
                                    Rp 0
                                @endif
                            </td>
                            <td class="px-4 py-2 border">
                                @if($pinjam->status == 'dipinjam')
                                    <form action="{{ route('admin.peminjaman.kembalikan', $pinjam->id) }}" method="POST" onsubmit="return confirm('Konfirmasi pengembalian buku ini?')">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                                            Konfirmasi
                                        </button>
                                    </form>
                                @else
                                    <em class="text-gray-400">-</em>
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
