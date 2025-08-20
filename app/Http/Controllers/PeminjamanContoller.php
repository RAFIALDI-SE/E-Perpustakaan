<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;

class PeminjamanController extends Controller
{

    public function index(Request $request)
    {
        $query = Buku::with('kategori')->where('stok', '>', 0);

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $bukus = $query->get();

        $peminjamanSaya = Peminjaman::with('buku')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $kategoris = Kategori::all();

        return view('peminjaman.index', compact('bukus', 'peminjamanSaya', 'kategoris'));
    }


    public function create(Request $request)
    {
        $buku = Buku::findOrFail($request->buku_id);
        return view('peminjaman.create', compact('buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_kembali' => 'required|date|after:today',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok < 1) {
            return redirect()->back()->with('error', 'Stok buku habis');
        }

        $peminjaman = Peminjaman::create([
            'user_id' => Auth::id(),
            'buku_id' => $buku->id,
            'tanggal_pinjam' => Carbon::now()->format('Y-m-d'),
            'tanggal_kembali' => $request->tanggal_kembali,
            'token' => strtoupper(Str::random(10)),
            'status' => 'menunggu',
        ]);

        $buku->decrement('stok');

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diajukan. Token: ' . $peminjaman->token);
    }

    public function kembalikan(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'dipinjam') {
            return back()->with('error', 'Buku ini belum dipinjam atau sudah dikembalikan.');
        }

        $now = Carbon::now();
        $tanggalKembali = Carbon::parse($peminjaman->tanggal_kembali);

        $denda = 0;
        if ($now->gt($tanggalKembali)) {
            $selisihHari = $now->diffInDays($tanggalKembali);
            $denda = $selisihHari * 1000;
        }

        $peminjaman->update([
            'status' => 'dikembalikan'
        ]);

        $peminjaman->buku->increment('stok');

        return back()->with('success', 'Buku berhasil dikembalikan. Denda: Rp' . number_format($denda, 0, ',', '.'));
    }

      public function adminIndex()
      {
            $peminjaman = Peminjaman::with(['user', 'buku'])->orderBy('created_at', 'desc')->get();
            return view('admin.index', compact('peminjaman'));
            // return $peminjaman;
      }

      public function validasi($id)
      {
          $peminjaman = Peminjaman::findOrFail($id);

          if ($peminjaman->status !== 'menunggu') {
              return back()->with('error', 'Peminjaman sudah divalidasi.');
          }

          $peminjaman->update(['status' => 'dipinjam']);

          return back()->with('success', 'Peminjaman berhasil divalidasi.');
      }

      public function adminPengembalian()
      {
          $peminjaman = Peminjaman::with(['user', 'buku'])
              ->where('status', 'dipinjam')
              ->orderBy('tanggal_kembali', 'asc')
              ->get();

          return view('admin.kembali', compact('peminjaman'));
      }

      public function adminKembalikan($id)
      {
          $peminjaman = Peminjaman::findOrFail($id);

          if ($peminjaman->status !== 'dipinjam') {
              return back()->with('error', 'Buku belum dipinjam atau sudah dikembalikan.');
          }

          $now = Carbon::now();
          $tanggalKembali = Carbon::parse($peminjaman->tanggal_kembali);

          $denda = 0;
          if ($now->gt($tanggalKembali)) {
              $selisihHari = $now->diffInDays($tanggalKembali);
              $denda = $selisihHari * 1000;
          }

          $peminjaman->update(['status' => 'dikembalikan']);
          $peminjaman->buku->increment('stok');

          return back()->with('success', 'Buku dikembalikan. Denda: Rp' . number_format($denda, 0, ',', '.'));
      }

      public function user()
      {
            $users = User::all();

            return $users;
      }
}
