<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Header;
use App\Models\Merk;
use App\Models\Jenis;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

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

        $merks = Merk::all(); 
        $jenis = Jenis::all(); 
        
        $products = Product::query()
            ->where('is_active', true)
            ->when($this->byMerks, fn($query) => $query->where('merks_id', $this->byMerks))
            ->when($this->byJenis, fn($query) => $query->where('jenis_id', $this->byJenis))
            ->when($this->search, fn($query) => $query->where('name', 'like', "%{$this->search}%"))
            ->with(['merk', 'jenis'])
            ->leftJoinSub(
                OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
                    ->groupBy('product_id'),
                'sales', // alias dari subquery. Subquery ini akan tampil seperti sebuah "tabel sementara" bernama sales.
                'products.id', // Ini adalah kolom dari tabel utama (products) yang akan dicocokkan.
                'sales.product_id' // Ini adalah kolom dari subquery sales yang akan dicocokkan dengan products.id.

                // ngapa perlu sales? ini wajib karena kita menggunakan leftJoinSub
                // alias [sales] pada subquery itu wajib saat menggunakan leftJoinSub()Alias sales pada subquery itu wajib saat menggunakan leftJoinSub()
            )
            ->orderByDesc('total_sold') // Produk dengan jumlah penjualan terbanyak muncul duluan
            ->select('products.*', DB::raw('COALESCE(total_sold, 0) as total_sold')) // Jika belum ada penjualan, anggap 0
            ->get(); 

        $conditions = ['baru', 'bekas'];

        return view('livewire.home.index', compact('headers','merks', 'jenis', 'products', 'conditions'));
        // compact('headers') mengirimkan variabel $headers ke dalam view
    }
}
