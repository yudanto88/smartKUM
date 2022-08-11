<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffUndang extends Model
{
    use HasFactory;

    protected $fillable = [
        'revisi_produk_hukum',
        'npknd',
        'status',
        'keterangan',
        'keterangan_penolakan',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function kasubagUndang()
    {
        return $this->hasOne(KasubagUndang::class);
    }
}
