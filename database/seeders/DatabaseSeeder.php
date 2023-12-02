<?php

namespace Database\Seeders;

use App\Models\AggregateScore;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AlternativeSeeder::class,
            CriteriaSeeder::class,
            DecisionMatrixSeeder::class,
            NormalizationSeeder::class,
            OptimizationAttributeSeeder::class,
            AggregateScoreSeeder::class
        ]);
    }
}
