<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'price', 'location', 'description', 'condition', 'jenis_id', 'merks_id'
    ];
    
    protected $casts = [
        'description' => 'array',
    ];

    // Relasi ke Merk
    public function merk()
    {
        return $this->belongsTo(Merk::class, 'merks_id');
    }

    // Relasi ke Jenis
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }
    
}
