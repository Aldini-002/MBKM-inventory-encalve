<?php

namespace Database\Seeders;

use App\Models\Finishing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinishingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Finishing::factory()->create([
            'name' => 'finishing 1',
        ]);
        Finishing::factory()->create([
            'name' => 'finishing 2',
        ]);
        Finishing::factory()->create([
            'name' => 'finishing 3',
        ]);
    }
}
