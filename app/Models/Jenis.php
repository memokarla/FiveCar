<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 

class Jenis extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image'];

    public function products()
    {
        return $this->hasMany(Product::class, 'jenis_id');
    }   

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) { // $model adalah objek dari model Jenis.
            // Buat slug dari name sebelum disimpan
            if (!$model->slug) { // Mengecek apakah kolom slug belum terisi
                $model->slug = Str::slug($model->name); 
                // Jika kolom slug kosong, maka slug diisi dengan hasil Str::slug($model->name)
                // Fungsi Str::slug() mengubah nilai name menjadi format slug 
            }
        });

        // setiap kali model diperbarui, slug selalu diperbarui sesuai name, tanpa pengecekan slug sebelumnya.
        static::updating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }
}
