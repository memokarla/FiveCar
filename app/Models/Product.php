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

    // Relasi ke Order Items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    protected $casts = [
        'description' => 'array',
    ];

    // slug
    public static function boot()
    {
        parent::boot();

        // saat model pertama kali dibuat, slug diisi otomatis dari name jika slug kosong.
        static::creating(function ($model) { 
            if (!$model->slug) { 
                $model->slug = Str::slug($model->merk->name . '-' . $model->name . '-' . $model->jenis->name); 
            }
        });

        // setiap kali model diperbarui, slug selalu diperbarui sesuai name, tanpa pengecekan slug sebelumnya.
        static::updating(function ($model) {
            $model->slug = Str::slug($model->merk->name . '-' . $model->name . '-' . $model->jenis->name); 
        });
    }
}
