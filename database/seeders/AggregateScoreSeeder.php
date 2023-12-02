<?php

namespace Database\Seeders;

use App\Models\AggregateScore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AggregateScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AggregateScore::calculateAggregateScores();
    }
}
