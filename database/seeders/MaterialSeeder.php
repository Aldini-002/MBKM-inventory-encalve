<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Material::factory()->create([
            'name' => 'material 1',
        ]);
        Material::factory()->create([
            'name' => 'material 2',
        ]);
        Material::factory()->create([
            'name' => 'material 3',
        ]);
    }
}
