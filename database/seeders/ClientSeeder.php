<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            [
                'document_number' => '41367866',
                'first_name' => 'Rudi',
                'last_name' => 'Vera',
                'email' => 'rudialonsovera@gmail.com',
                'phone' => '956754656',
            ],
            [
                'document_number' => '72911458',
                'first_name' => 'Camila',
                'last_name' => 'Rojas',
                'email' => 'camila.rojas@vip2cars.pe',
                'phone' => '982441100',
            ],
            [
                'document_number' => '50873421',
                'first_name' => 'Luis',
                'last_name' => 'Quispe',
                'email' => 'luis.quispe@vip2cars.pe',
                'phone' => '977300211',
            ],
        ];

        foreach ($clients as $clientData) {
            $existingByDocument = Client::where('document_number', $clientData['document_number'])->first();
            $existingByEmail = Client::where('email', $clientData['email'])->first();

            $client = $existingByDocument ?? $existingByEmail;

            if (! $client) {
                Client::create($clientData);
                continue;
            }

            $client->update($clientData);
        }
    }
}
