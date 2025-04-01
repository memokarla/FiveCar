<?php

namespace App\Livewire\OrderDetail;

use Livewire\Component;
use App\Models\Order;

class Index extends Component
{
    public $id;
    public $order;
    public $product;
    public $address;

    public function getPaymentMethodLabel()
    {
        $paymentMethods = [
            'cod' => 'Cash on Delivery',
            'stripe' => 'Stripe',
        ];

        // return $paymentMethods[$this->order->payment_method];
        return $paymentMethods[$this->order->payment_method] ?? 'Unknown';
    }
    
    public function getShippingMethodLabel()
    {
        $shippingMethods = [
            'pickupAtDealer' => 'Pickup at Dealer',
            'homeDelivery' => 'Home Delivery',
            'carCarrier' => 'Car Carrier',
            'roRoShipping' => 'Ro-Ro Shipping',
            'driverDelivery' => 'Driver Delivery',
        ];

        // return $shippingMethods[$this->order->shipping_method];
        return $shippingMethods[$this->order->shipping_method] ?? 'Unknown';
    }
    
    public function mount($id)
    {
        $this->id = $id;
        $this->order = Order::where('id', $id)->firstOrFail();
        $this->product = $this->order->orderItems->first()->product ?? null;
        $this->address = $this->order->address ?? null;
    }

    public function render()
    {
        return view('livewire.order-detail.index', [
            'order' => $this->order,
        ]);
    }
}
