<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalEquipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'quantity',
        'minimum_stock',
        'unit',
        'description',
        'status',
        'purchase_date',
        'last_maintenance_date',
        'location',
        'building',
        'floor',
        'room',
        'room_name'
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'last_maintenance_date' => 'date'
    ];
} 