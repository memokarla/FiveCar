<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'image', 'price', 'location', 'description', 'condition', 'is_active', 'on_sale', 'jenis_id', 'merks_id'
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
    
    protected $casts = [
        'description' => 'array',
    ];

    // slug
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) { 
            if (!$model->slug) { 
                $model->slug = Str::slug($model->name); 
            }
        });
    }
}
