<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;

    protected $fillable = ['is_active', 'image', 'text', 'button']; 

    protected $casts = [
        'button' => 'array',
    ];    
}
