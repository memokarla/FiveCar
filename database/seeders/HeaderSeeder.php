<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Header;

class HeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $headers = Header::insert([
            [
                'is_active' => true, 
                'image' => 'images/headers/slider1.jpeg',
            ],
            [
                'is_active' => true, 
                'image' => 'images/headers/slider2.jpeg',
            ],
            [
                'is_active' => true, 
                'image' => 'images/headers/slider3.jpeg',
            ],
            [
                'is_active' => true, 
                'image' => 'images/headers/slider4.jpeg',
            ],
        ]);
    }
}
