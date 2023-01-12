<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'key' => 'start_datetime',
            'value' => '2024-04-14 18:00:00'
        ]);
        Setting::create([
            'key' => 'end_datetime',
            'value' => '2024-04-15 18:00:00'
        ]);
    }
}
