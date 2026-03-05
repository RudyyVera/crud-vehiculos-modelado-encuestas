<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'plate' => 'ABC-123',
                'brand' => 'Toyota',
                'model' => 'Corolla XEI',
                'manufacturing_year' => 2022,
                'client_document' => '41367866',
            ],
            [
                'plate' => 'BCD-456',
                'brand' => 'Hyundai',
                'model' => 'Tucson GLS',
                'manufacturing_year' => 2021,
                'client_document' => '72911458',
            ],
            [
                'plate' => 'CDE-789',
                'brand' => 'Kia',
                'model' => 'Sportage EX',
                'manufacturing_year' => 2023,
                'client_document' => '50873421',
            ],
        ];

        foreach ($vehicles as $vehicleData) {
            $client = Client::where('document_number', $vehicleData['client_document'])->first();

            if (! $client) {
                continue;
            }

            $client->vehicles()->updateOrCreate(
                ['plate' => $vehicleData['plate']],
                [
                    'brand' => $vehicleData['brand'],
                    'model' => $vehicleData['model'],
                    'manufacturing_year' => $vehicleData['manufacturing_year'],
                ]
            );
        }
    }
}
