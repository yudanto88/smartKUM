<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis',
        'judul',
        'tanggal_pengajuan',
        'keterangan',
        'surat_pengajuan',
        'draft_produk_hukum',
        'keterangan_penolakan',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function draft_admins()
    {
        return $this->hasOne(Admin::class);
    }
}
