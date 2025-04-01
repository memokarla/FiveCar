<?php

namespace App\Livewire\Checkout;

use Livewire\Component;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;

class Index extends Component
{
    public $product;
    public $id; 

    public $name, $phone, $street_address, $city, $state, $zip_code, $payment_method, $shipping_method, $grand_total; 
    public $tax = 0;
    
    public function placeOrder() {
        $this->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required|numeric',
            'payment_method' => 'required',
            'shipping_method' => 'required',
        ]);
    
        $order = Order::create([
            'grand_total' => $this->product->price * (1 + $this->tax / 100),
            'payment_method' => $this->payment_method,
            'payment_status' => 'pending',
            'shipping_method' => $this->shipping_method,
            'tax' => $this->tax,
            'status' => 'new',
            'user_id' => auth()->id() ?? 1, // Default user_id kalau belum login
        ]);
    
        $address = Address::create([
            'order_id' => $order->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'street_address' => $this->street_address,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
        ]);
    
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $this->product->id,
            'unit_amount' => $this->product->price,
            'total_amount' => $this->product->price * 1, // Misal quantity 1
            'quantity' => 1,
        ]);
    
        session()->flash('message', 'Payment Successful!');
        session()->flash('order_id', $order->id);
    }
    
    public function updatedShippingMethod($value)
    {
        $taxRates = [
            'pickupAtDealer' => 0,  
            'homeDelivery' => 5,    
            'carCarrier' => 7,      
            'roRoShipping' => 8,    
            'driverDelivery' => 6,  
        ];

        $this->tax = $taxRates[$value] ?? 0;
        $this->updateGrandTotal();
    }

    public function updateGrandTotal()
    {
        $taxAmount = ($this->product->price * $this->tax) / 100;
        $this->grand_total = $this->product->price + $taxAmount;
    }

    public function mount($id)
    {
        $this->id = $id;
        $this->product = Product::where('id', $id)->firstOrFail();
        $this->tax = 0;
        $this->updateGrandTotal();
    }

    public function render()
    {
        $order = Order::where('user_id', auth()->id() ?? 1)->latest()->first();

        return view('livewire.checkout.index', [
            'product' => $this->product,
            'order' => $order, 
        ]);
    }
}
