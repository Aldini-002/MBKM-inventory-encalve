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
            'name' => 'Teak wood',
        ]);
        Material::factory()->create([
            'name' => 'Munggur wood',
        ]);
        Material::factory()->create([
            'name' => 'Mahogany wood',
        ]);
        Material::factory()->create([
            'name' => 'Sisal',
        ]);
        Material::factory()->create([
            'name' => 'Ctolh',
        ]);
        Material::factory()->create([
            'name' => 'Iron',
        ]);
        Material::factory()->create([
            'name' => 'Cow leather',
        ]);
        Material::factory()->create([
            'name' => 'Goat leather',
        ]);
    }
}
