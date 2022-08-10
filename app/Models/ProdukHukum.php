<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukHukum extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_tahun',
        'tentang',
        'subjek',
        'status',
        'tanggal_pengundangan',
    ];

    public function staffDokumentasi(){
        return $this->belongsTo(StaffDokumentasi::class);
    }
}
