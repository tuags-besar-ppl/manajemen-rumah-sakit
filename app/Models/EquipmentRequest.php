<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\NotifiesActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentRequest extends Model
{
    use HasFactory, NotifiesActivity, SoftDeletes;

    protected $table = 'equipment_requests';

    protected $fillable = [
        'user_id',
        'alat_id',
        'alasan',
        'tanggal_permintaan',
        'status'
    ];

    protected $casts = [
        'tanggal_permintaan' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationship with Equipment
    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'alat_id');
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor untuk memastikan tanggal_permintaan selalu dalam format Carbon
    public function getTanggalPermintaanAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }
} 