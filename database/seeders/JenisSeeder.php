<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jenis;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis = Jenis::insert([
            [
                'name' => 'Sedan', 
                'slug' => 'sedan',
                'image' => 'images/jenis/sedan.jpg',
            ],
            [
                'name' => 'MPV', 
                'slug' => 'mpv',
                'image' => 'images/jenis/mpv.jpg',
            ],
            [
                'name' => 'SUV', 
                'slug' => 'suv',
                'image' => 'images/jenis/suv.jpg',
            ],
            [
                'name' => 'Crossover', 
                'slug' => 'crossover',
                'image' => 'images/jenis/crossover.jpg',
            ],
            [
                'name' => 'Minivans', 
                'slug' => 'minivans',
                'image' => 'images/jenis/minivans.jpg',
            ],
            [
                'name' => 'Pickup Truck', 
                'slug' => 'pickup-truck',
                'image' => 'images/jenis/pickup-truck.jpg',
            ],
            [
                'name' => 'Coupe', 
                'slug' => 'coupe',
                'image' => 'images/jenis/coupe.jpg',
            ],
            [
                'name' => 'VAN', 
                'slug' => 'van',
                'image' => 'images/jenis/van.jpg',
            ],
            [
                'name' => 'Wagon', 
                'slug' => 'wagon',
                'image' => 'images/jenis/wagon.jpg',
            ],
            [
                'name' => 'Sportback', 
                'slug' => 'sportback',
                'image' => 'images/jenis/sportback.jpg',
            ],
            [
                'name' => 'Convertible', 
                'slug' => 'convertible',
                'image' => 'images/jenis/convertible.jpg',
            ],
            [
                'name' => 'Hatchback', 
                'slug' => 'hatchback',
                'image' => 'images/jenis/hatchback.jpg',
            ],
        ]);
    }
}
