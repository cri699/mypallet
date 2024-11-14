<?php

namespace Database\Seeders;

use App\Models\TransportUnit;
use Illuminate\Database\Seeder;

class TransportUnitSeeder extends Seeder
{
    public function run()
    {
        // Generate 50 transport units
        TransportUnit::factory()->count(50)->create();
    }
}
