<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasubagUndang extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'keterangan',
        'keterangan_penolakan',
    ];

    public function staffUndang(){
        return $this->belongsTo(StaffUndang::class);
    }

    public function kabag(){
        return $this->hasOne(KabagUndang::class);
    }
}
