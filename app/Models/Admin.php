<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'keterangan',
        'keterangan_penolakan',
    ];

    public function draft()
    {
        return $this->belongsTo(Draft::class);
    }

    public function staffUndang()
    {
        return $this->hasOne(StaffUndang::class);
    }
}
