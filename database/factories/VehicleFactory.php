<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vehicle>
 */
class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        return [
            'plate' => strtoupper($this->faker->bothify('???-###')),
            'brand' => $this->faker->randomElement(['Toyota', 'Chevrolet', 'Hyundai', 'Kia', 'Nissan', 'Mazda', 'Suzuki', 'Volkswagen']),
            'model' => $this->faker->randomElement(['Corolla', 'Yaris', 'Hilux', 'Onix', 'Aveo', 'Tucson', 'Sportage', 'Sentra', 'CX-5', 'Vitara']),
            'manufacturing_year' => $this->faker->numberBetween(2008, (int) date('Y') + 1),
            'client_id' => Client::factory(),
        ];
    }
}
