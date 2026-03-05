<?php

namespace Database\Seeders;

use Database\Factories\VehiculoFactory;
use Illuminate\Database\Seeder;

class VehiculoSeeder extends Seeder
{
    public function run(): void
    {
        VehiculoFactory::new()
            ->count(15)
            ->create();
    }
}
