<?php

namespace App\Livewire\ProductDetail;

use Livewire\Component;
use App\Models\Product;

class Index extends Component
{
    public $product;
    public $slug; // Simpan slug

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->product = Product::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.product-detail.index', [
            'product' => $this->product
        ]);
    }
}
