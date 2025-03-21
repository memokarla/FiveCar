<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['grand_total', 'payment_method', 'payment_status', 'tax', 'status', 'shipping_method', 'user_id'];
    
    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Order Item
    public function orderItems() 
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relasi ke Address
    public function address()
    {
        return $this->hasOne(Address::class);
    }

}
