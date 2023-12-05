<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static distinct(string $string)
 */
class OptimizationAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternative_id',
        'criterion_id',
        'value',
    ];

    public $timestamps = false;

    private static array $criterionWeights = [];

    public static function createOptimizationAttributes(): void
    {
        $normalizations = Normalization::all();

        foreach ($normalizations as $cell) {
            self::create([
                'alternative_id' => $cell->alternative_id,
                'criterion_id' => $cell->criterion_id,
                'value' => self::calculateCellValue($cell),
            ]);
        }
    }

    private static function calculateCellValue($currentCell): float|int
    {
        $criterionId = $currentCell->criterion_id;

        if (!array_key_exists($criterionId, self::$criterionWeights)) {
            $weight = Criterion::where('id', $criterionId)->value('weight');

            self::$criterionWeights[$criterionId] = $weight;
        }

        return $currentCell->value * self::$criterionWeights[$criterionId];
    }
}
