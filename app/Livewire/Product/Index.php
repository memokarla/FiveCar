<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Merk;
use App\Models\Jenis;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $selected_merks = [];
    public $selected_jenis = [];
    public $selected_condition = [];
    public $selected_fuelType = [];
    public $selected_price = '';
    public $selected_sortBy = 'default';

    protected $queryString = [
        'selected_merks' => ['as' => 'brand'],
        'selected_jenis' => ['as' => 'category'],
        'selected_condition' => ['as' => 'condition'],
        'selected_fuelType' => ['as' => 'fuelType'],
    ];

    public function removeFilter($filterType, $value = null)
    {
        switch ($filterType) {
            case 'merk':
                $this->selected_merks = array_diff($this->selected_merks, [$value]);
                break;

            case 'jenis':
                $this->selected_jenis = array_diff($this->selected_jenis, [$value]);
                break;

            case 'condition':
                $this->selected_condition = array_diff($this->selected_condition, [$value]);
                break;

            case 'fuelType':
                $this->selected_fuelType = array_diff($this->selected_fuelType, [$value]);
                break;

            case 'price':
                $this->selected_price = null;
                break;
        }

        // Reset pagination when filters change
        $this->resetPage();
    }
    
    public function render()
    {
        $merks = Merk::all(); 
        $jenis = Jenis::all(); 
        $productsQuery = Product::query();

        // serach
        if (!empty($this->search)) {
            $productsQuery->where('name', 'like', '%' . $this->search . '%');
        }

        // merk
        if (!empty($this->selected_merks)) {
            $productsQuery->whereIn('merks_id', $this->selected_merks);
        }

        // jenis
        if (!empty($this->selected_jenis)) {
            $productsQuery->whereIn('jenis_id', $this->selected_jenis);
        }

        // kondisi
        if ($this->selected_condition) {
            $productsQuery->where('condition', $this->selected_condition);
        }

        // fuel type
        if ($this->selected_fuelType) {
            $productsQuery->where('description->fuel_type', $this->selected_fuelType);
        }

        // harga
        if ($this->selected_price) {
            // Pisahkan rentang harga menjadi dua bagian: min_price dan max_price
            if ($this->selected_price == '< Rp 150 Juta') {
                $productsQuery->where('price', '<', 150000000);
            } elseif ($this->selected_price == 'Rp 150 Juta - Rp 300 Juta') {
                $productsQuery->whereBetween('price', [150000001, 300000000]);
            } elseif ($this->selected_price == 'Rp 300 Juta - Rp 600 Juta') {
                $productsQuery->whereBetween('price', [300000001, 600000000]);
            } elseif ($this->selected_price == 'Rp 600 Juta - Rp 1 M') {
                $productsQuery->whereBetween('price', [600000001, 1000000000]);
            } elseif ($this->selected_price == 'Rp 1 M') {
                $productsQuery->where('price', '>', 1000000000);
            }
        }

        // Sorting
        if ($this->selected_sortBy == 'price_asc') {
            $productsQuery->orderBy('price', 'asc');
        } elseif ($this->selected_sortBy == 'price_desc') {
            $productsQuery->orderBy('price', 'desc');
        } elseif ($this->selected_sortBy == 'newest') {
            $productsQuery->orderBy('created_at', 'desc');
        }

        $products = $productsQuery->paginate(9);
        
        return view('livewire.product.index', [
            'products' => $products,
            'merks' => $merks,
            'jenis' => $jenis,
        ]);
    }
}
