<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walikota extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'keterangan',
        'keterangan_penolakan',
    ];

    public function sekda(){
        return $this->belongsTo(Sekda::class);
    }

    public function staffDokumentasi(){
        return $this->hasOne(StaffDokumentasi::class);
    }
}
