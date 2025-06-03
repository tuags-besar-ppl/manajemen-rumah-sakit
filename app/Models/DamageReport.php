<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DamageReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'alat_id',
        'user_id',
        'deskripsi_kerusakan',
        'tanggal_kerusakan',
        'lokasi',
        'prioritas',
        'status',
        'catatan'
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'alat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
