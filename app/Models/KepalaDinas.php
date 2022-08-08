<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaDinas extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'keterangan',
        'keterangan_penolakan',
    ];

    public function kabag(){
        return $this->belongsTo(Kabag::class);
    }

    public function sekda(){
        return $this->hasMany(Sekda::class);
    }
}
