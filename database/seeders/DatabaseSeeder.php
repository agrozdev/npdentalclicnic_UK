<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'atanasgrozdev@yahoo.com'],
            [
                'name'     => 'NP Dental Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('w3bd3v..'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'info@npdentalclinic.com'],
            [
                'name'     => 'NP Dental Clinic',
                'password' => \Illuminate\Support\Facades\Hash::make('P@rol@112233'),
            ]
        );
    }
}
