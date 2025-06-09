<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Merk;

class MerkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $merks = Merk::insert([
            [
                'name' => 'Toyota', 
                'slug' => 'toyota',
                'image' => 'images/merk/toyota.jpg',
            ],
            [
                'name' => 'Daihatsu', 
                'slug' => 'daihatsu',
                'image' => 'images/merk/daihatsu.jpg',
            ],
            [
                'name' => 'Honda', 
                'slug' => 'honda',
                'image' => 'images/merk/honda.jpg',
            ],
            [
                'name' => 'Mitsubishi', 
                'slug' => 'mitsubishi',
                'image' => 'images/merk/mitsubishi.jpg',
            ],
            [
                'name' => 'Suzuki', 
                'slug' => 'suzuki',
                'image' => 'images/merk/suzuki.jpg',
            ],
            [
                'name' => 'Hyundai', 
                'slug' => 'hyundai',
                'image' => 'images/merk/hyundai.jpg',
            ],
            [
                'name' => 'Wuling', 
                'slug' => 'wuling',
                'image' => 'images/merk/wuling.jpg',
            ],
            [
                'name' => 'KIA', 
                'slug' => 'kia',
                'image' => 'images/merk/kia.jpg',
            ],
            [
                'name' => 'BMW', 
                'slug' => 'bmw',
                'image' => 'images/merk/bmw.jpg',
            ],
            [
                'name' => 'Mazda', 
                'slug' => 'mazda',
                'image' => 'images/merk/mazda.jpg',
            ],
            [
                'name' => 'Isuzu', 
                'slug' => 'isuzu',
                'image' => 'images/merk/isuzu.jpg',
            ],
            [
                'name' => 'Ford', 
                'slug' => 'ford',
                'image' => 'images/merk/ford.jpg',
            ],
            [
                'name' => 'Tesla', 
                'slug' => 'tesla',
                'image' => 'images/merk/tesla.jpg',
            ],
            [
                'name' => 'Mercedes-Benz', 
                'slug' => 'mercedes-benz',
                'image' => 'images/merk/mercedes-benz.jpg',
            ],
            [
                'name' => 'Renault', 
                'slug' => 'renault',
                'image' => 'images/merk/renault.jpg',
            ],
            [
                'name' => 'Volvo', 
                'slug' => 'volvo',
                'image' => 'images/merk/volvo.jpg',
            ],
            [
                'name' => 'BYD', 
                'slug' => 'byd',
                'image' => 'images/merk/byd.jpg',
            ],
            [
                'name' => 'Peugeot', 
                'slug' => 'peugeot',
                'image' => 'images/merk/peugeot.jpg',
            ],
        ]);    
    }
}
