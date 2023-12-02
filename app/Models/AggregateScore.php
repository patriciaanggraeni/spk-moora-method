<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
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

    public static function calculateAggregateScores(): void
    {
        $optimizationAttributes = OptimizationAttribute::all();

        foreach ($optimizationAttributes as $optimizationAttribute) {
            $criterionId = $optimizationAttribute->criterion_id;
            $alternativeId = $optimizationAttribute->alternative_id;
            $value = $optimizationAttribute->value;

            if (self::isBenefit($criterionId)) {
                self::$alternatives[$alternativeId]['benefits'][$criterionId] = $value;
            } else {
                self::$alternatives[$alternativeId]['costs'][$criterionId] = $value;
            }
        }

        foreach (self::$alternatives as $alternativeId => $alternativeValue) {
            $totalBenefits = array_sum($alternativeValue['benefits']);
            $totalCosts = array_sum($alternativeValue['costs']);

            self::create([
                'alternative_id' => $alternativeId,
                'value' => $totalBenefits - $totalCosts,
            ]);
        }

    }

    static function isBenefit($criterionId): bool
    {
        static $criteriaTypes = [];

        if (!array_key_exists($criterionId, $criteriaTypes)) {
            $criterionType = Criterion::find($criterionId)->type;
            $criteriaTypes[$criterionId] = $criterionType;
        }

        return $criteriaTypes[$criterionId] == 'benefit';
    }
}
