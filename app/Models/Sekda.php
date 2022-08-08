<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekda extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'keterangan',
        'keterangan_penolakan',
    ];

    public function kepalaDinas(){
        return $this->belongsTo(KepalaDinas::class);
    }
}
