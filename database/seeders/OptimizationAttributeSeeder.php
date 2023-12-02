<?php

namespace Database\Seeders;

use App\Models\OptimizationAttribute;
use Illuminate\Database\Seeder;

class OptimizationAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OptimizationAttribute::calculateAndInsertAttributes();
    }
}
