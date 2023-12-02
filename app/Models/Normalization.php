<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Normalization extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternative_id',
        'criterion_id',
        'value',
    ];

    public $timestamps = false;

    private static array $columns = [];

    public static function calculateAndInsertNormalizations(): void
    {
        $decisionMatrices = DecisionMatrix::all();

        foreach ($decisionMatrices as $cell) {
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

        if (!array_key_exists($criterionId, self::$columns)) {
            $cellsByCriterion = DecisionMatrix::where('criterion_id', $criterionId)->get();

            $column = 0;

            foreach ($cellsByCriterion as $cell) {
                $column += $cell->value * $cell->value;
            }

            $column = sqrt($column);

            self::$columns[$criterionId] = $column;
        }

        return $currentCell->value / self::$columns[$criterionId];
    }
}
