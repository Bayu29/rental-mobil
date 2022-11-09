<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Driver;
use Carbon\Carbon;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $driver = Driver::create([
            'name' => 'Supardi',
            'number_sim_card' => '2424325234232',
            'gender' => 'male',
            'birthday' => Carbon::now(),
            'status' => 'available',
            'phone'=> '08987499383',
            'address' => 'efgsdbfugusdygfuysd',
            'fee' => 100000
        ]);
    }
}
