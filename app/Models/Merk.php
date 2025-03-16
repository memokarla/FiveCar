<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image']; 

    public function products()
    {
        return $this->hasMany(Product::class, 'merks_id');
    }
}
