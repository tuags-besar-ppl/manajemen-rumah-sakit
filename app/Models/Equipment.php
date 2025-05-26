<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'location',
        'status',
        'quantity',
        'aksi'
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'last_maintenance_date' => 'date'
    ];
} 