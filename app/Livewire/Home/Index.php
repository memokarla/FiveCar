<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Header;
use App\Models\Jenis;
use App\Models\Product;

class Index extends Component
{
    public $byMerks = null;
    public $byJenis = null;
    public $search = '';

    public function render()
    {
        // Mengambil semua data dari tabel headers yang memiliki nilai is_active = true
        $headers = Header::where('is_active', true)->get();
        // $headers merupakan nama variabel, jadi bebas namanya
        // Header merupakan nama model yang hendak dibaca, jangan lupa dikenalkan dengan use
        // Nah, where nya itu seperti kita mensetting kondisi, untuk mengambil data yang memiliki status is_active
        // get(), sesuai nama, untuk mengambil semua hasilnya

        $jenis = Jenis::all(); 
        // $products = Product::all(); 
        $products = Product::query()
            ->when($this->byMerks, fn($query) => $query->where('merks_id', $this->byMerks))
            ->when($this->byJenis, fn($query) => $query->where('jenis_id', $this->byJenis))
            ->when($this->search, fn($query) => $query->where('name', 'like', "%{$this->search}%"))
            ->with(['merk', 'jenis']) // Tambahkan ini
            ->get();    

        $conditions = ['baru', 'bekas'];

        return view('livewire.home.index', compact('headers', 'jenis', 'products', 'conditions'));
        // compact('headers') mengirimkan variabel $headers ke dalam view
    }
}
