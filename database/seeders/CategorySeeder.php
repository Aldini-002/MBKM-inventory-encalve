<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Category::factory()->create([
            'name' => 'Chair',
        ]);
        Category::factory()->create([
            'name' => 'Cupboard',
        ]);
        Category::factory()->create([
            'name' => 'Decoration',
        ]);
        Category::factory()->create([
            'name' => 'Stand',
        ]);
        Category::factory()->create([
            'name' => 'Shelf',
        ]);
        Category::factory()->create([
            'name' => 'Table',
        ]);
    }
}
