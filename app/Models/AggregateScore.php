<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static pluck(string $string)
 * @method static truncate()
 */
class AggregateScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternative_id',
        'score'
    ];

    public $timestamps = false;

    private static array $alternatives = [];

    public static function calculateAndGetAggregateScores(): array
    {
        $optimizationAttributes = OptimizationAttribute::all();

        foreach ($optimizationAttributes as $optimizationAttribute) {
            $alternativeId = $optimizationAttribute->id;
            $criterionId = $optimizationAttribute->criterion_id;
            $value = $optimizationAttribute->value;

            if (!isset(self::$alternatives[$alternativeId])) {
                self::$alternatives[$alternativeId] = [
                    'totalBenefit' => 0,
                    'totalCost' => 0,
                ];
            }

            if (self::isBenefit($criterionId)) {
                self::$alternatives[$alternativeId]['benefit'][$criterionId] = $value;
                self::$alternatives[$alternativeId]['totalBenefit'] += $value;
            } else {
                self::$alternatives[$alternativeId]['costs'][$criterionId] = $value;
                self::$alternatives[$alternativeId]['totalCost'] += $value;
            }
        }

        return self::$alternatives;
    }

    public static function createAggregateScores(): void
    {
        $alternatives = self::calculateAndGetAggregateScores();

        foreach ($alternatives as $alternativeId => $alternativeValue) {
            $totalBenefits = $alternativeValue['totalBenefit'];
            $totalCosts = $alternativeValue['totalCost'];

            self::create([
                'alternative_id' => $alternativeId,
                'value' => $totalBenefits - $totalCosts,
            ]);
        }
    }

    private static function isBenefit($criterionId): bool
    {
        static $criteriaTypes = [];

        if (!array_key_exists($criterionId, $criteriaTypes)) {
            $criterionType = Criterion::find($criterionId)->type;
            $criteriaTypes[$criterionId] = $criterionType;
        }

        return $criteriaTypes[$criterionId] == 'benefit';
    }
}
