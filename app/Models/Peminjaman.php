<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Peminjaman extends Model
{
    protected $fillable = [
        'user_id', 'buku_id', 'tanggal_pinjam', 'tanggal_kembali',
        'token', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function getDendaAttribute()
    {
        if ($this->status !== 'dikembalikan' && now()->gt($this->tanggal_kembali)) {
            $hariTerlambat = Carbon::parse($this->tanggal_kembali)->diffInDays(now());
            return $hariTerlambat * 1000;
        }
        return 0;
    }
}
