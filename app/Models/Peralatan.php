<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'peralatan';

    // The attributes that are mass assignable.
    protected $fillable = [
        'nama',
        'kode',
        'lokasi',
        'status',
        'deskripsi',
        'kategori',
        'klasifikasi',
    ];
}
