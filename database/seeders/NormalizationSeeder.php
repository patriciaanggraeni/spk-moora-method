<?php

namespace Database\Seeders;

use App\Models\Normalization;
use Illuminate\Database\Seeder;

class NormalizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Normalization::createNormalizations();
    }
}
