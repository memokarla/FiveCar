<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Header extends Model
{
    use HasFactory;

    protected $fillable = ['is_active', 'image', 'text', 'button']; 

    protected $casts = [
        'button' => 'array',
    ];    

    protected static function boot() 
    {
        parent::boot();

        static::deleting(function ($header) {
            if ($header->image) {
                Storage::disk('public')->delete($header->image);
            }
        });
    }
}
