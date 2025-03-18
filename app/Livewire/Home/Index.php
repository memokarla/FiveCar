<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Header;
use App\Models\Merk;

class Index extends Component
{    
    public function render()
    {
        // Mengambil semua data dari tabel headers yang memiliki nilai is_active = true
        $headers = Header::where('is_active', true)->get(); 
        // $headers merupakan nama variabel, jadi bebas namanya
        // Header merupakan nama model yang hendak dibaca, jangan lupa dkenalkan dengan use
        // Nah, where nya itu seperti kita mensetting kondisi, untuk mengambil data yang memiliki status is_active
        // get(), sesuai nama, untuk mengambil semua hasilnya 

        // ambil semua data merk
        $merks = Merk::all(); 

        return view('livewire.home.index', compact('headers', 'merks'));
        // compact('headers') mengirimkan variabel $headers ke dalam view
    }
}
