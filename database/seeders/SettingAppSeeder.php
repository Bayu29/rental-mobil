<?php

namespace Database\Seeders;

use App\Models\SettingApp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SettingAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingApp::create([
            'app_name' => '',
            'logo' => '',
            'favicon' => '',
            'phone' => '',
            'email' => 'admin@gmail.com',
            'address' => '',
            'late_fee' => 100000,
            'is_password_expired' => 'Yes',
        ]);
    }
}
