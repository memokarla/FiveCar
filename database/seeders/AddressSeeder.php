<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mengambil Order yang sudah ada
        $existingOrder = \App\Models\Order::find(1);  // atau menggunakan findOrFail() jika ingin exception

        // Membuat Address dan menghubungkannya dengan Order yang sudah ada
        \App\Models\Address::factory()->create([
            'order_id' => $existingOrder->id,
        ]);
    }
}
