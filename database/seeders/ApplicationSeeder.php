<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Application::factory()->create([
            'name' => 'app 1',
        ]);
        Application::factory()->create([
            'name' => 'app 2',
        ]);
        Application::factory()->create([
            'name' => 'app 3',
        ]);
    }
}
