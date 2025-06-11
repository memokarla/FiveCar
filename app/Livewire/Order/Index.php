<?php

namespace App\Livewire\Order;

use Livewire\Component;
use App\Models\Order;

use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    
    public function render()
    {
        // Ambil order yang terkait dengan user yang sedang login
        $orders = Order::where('user_id', Auth::id()) // Filter berdasarkan ID user yang login
            ->with('orderItems.product') // Eager load relasi orderItems dan product
            ->get();

        return view('livewire.order.index', compact('orders'));
    }
}
