<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_order' ,
        'grand_total', 
        'payment_method', 
        'payment_status', 
        'tax', 
        'status', 
        'shipping_method', 
        'user_id'];
    
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->code_order = self::generateCode();
        });
    }

    private static function generateCode()
    {
        $tanggal = now()->format('ymd'); // contoh: 250408
        $count = self::whereDate('created_at', now()
        ->toDateString())->count() + 1;
        $kode = 'ORD-' . $tanggal . '-' . str_pad(
            $count, 3, '0', STR_PAD_LEFT);
        return $kode;
    }
}
