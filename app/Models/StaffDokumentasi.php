<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDokumentasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'ttd_walikota',
        'keterangan',
        'keterangan_penolakan',
    ];

    public function walikota(){
        return $this->belongsTo(Walikota::class);
    }
}
