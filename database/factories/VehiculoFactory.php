<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vehicle>
 */
class VehiculoFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        $catalog = [
            ['brand' => 'Toyota', 'model' => 'RAV4'],
            ['brand' => 'Chevrolet', 'model' => 'Tracker'],
            ['brand' => 'Mazda', 'model' => 'CX-5'],
            ['brand' => 'Nissan', 'model' => 'Sentra'],
            ['brand' => 'Hyundai', 'model' => 'Tucson'],
        ];

        $selection = $this->faker->randomElement($catalog);

        return [
            'plate' => strtoupper($this->faker->unique()->bothify('???-###')),
            'brand' => $selection['brand'],
            'model' => $selection['model'],
            'manufacturing_year' => $this->faker->numberBetween(2016, (int) date('Y') + 1),
            'client_id' => Client::factory(),
        ];
    }
}
