<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $car = Car::create([
            'name' => 'Avanza',
            'color' => 'Hitam',
            'police_number' => 'AE 2371 BE',
            'cc' => '250',
            'capacity' => 6,
            'year' => 2021,
            'type' => 'matic',
            'status' => 'available',
            'fee' => 200000
        ]);
    }
}
