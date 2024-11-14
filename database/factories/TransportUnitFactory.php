<?php

namespace Database\Factories;

use App\Models\TransportUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransportUnitFactory extends Factory
{
    protected $model = TransportUnit::class;

    public function definition() : array
    {
        return [
            'name' => $this->faker->company,
            'type' => $this->faker->randomElement(['truck', 'trailer']), // Randomly select between truck or trailer
        ];
    }
}
