<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekda extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'persetujuan',
        'keterangan',
        'keterangan_penolakan',
    ];

    public function kepalaDinas(){
        return $this->belongsTo(KepalaDinas::class);
    }

    public function walikota(){
        return $this->hasOne(Walikota::class);
    }
}
