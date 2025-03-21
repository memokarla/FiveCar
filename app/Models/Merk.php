<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 

class Merk extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image']; 

    public function products()
    {
        return $this->hasMany(Product::class, 'merks_id');
    }

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
