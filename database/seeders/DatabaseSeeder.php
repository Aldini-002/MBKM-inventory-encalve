<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Buyer;
use App\Models\Suplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Suplier::factory(10)->create();
        Buyer::factory(10)->create();

        $this->call([
            ApplicationSeeder::class,
            CategorySeeder::class,
            MaterialSeeder::class,
            FinishingSeeder::class,
            FurnitureSeeder::class,
            FurnitureImageSeeder::class,
        ]);
    }
}
