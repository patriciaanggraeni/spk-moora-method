<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static pluck(string $string)
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
            $criterionId = $optimizationAttribute->criterion_id;
            $alternativeId = $optimizationAttribute->alternative_id;
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
//
//namespace App\Models;
//
//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
//
///**
// * @method static create(array $array)
// */
//class AggregateScore extends Model
//{
//    use HasFactory;
//
//    protected $fillable = [
//        'alternative_id',
//        'score'
//    ];
//
//    public $timestamps = false;
//
//    private static array $alternatives = [];
//
//    public static array $totalBenefits = [];
//
//    public static array $totalCosts = [];
//
//    public static function getAlternatives(): array
//    {
//        $optimizationAttributes = OptimizationAttribute::all();
//
//        foreach ($optimizationAttributes as $optimizationAttribute) {
//            $criterionId = $optimizationAttribute->criterion_id;
//            $alternativeId = $optimizationAttribute->alternative_id;
//            $value = $optimizationAttribute->value;
//
//            if (self::isBenefit($criterionId)) {
//                self::$alternatives[$alternativeId]['benefits'][$criterionId] = $value;
//            } else {
//                self::$alternatives[$alternativeId]['costs'][$criterionId] = $value;
//            }
//        }
//
//        return self::$alternatives;
//    }
//
//    public static function getBenefitsCosts(): array
//    {
//        $alternatives =  self::getAlternatives();
//
//        foreach ($alternatives as $alternativeId => $alternativeValue) {
//            self::$totalBenefits[$alternativeId] = array_sum($alternativeValue['benefits']);
//            self::$totalCosts[$alternativeId] = array_sum($alternativeValue['costs']);
//        }
//
//        return [
//            'alternatives' => $alternatives,
//            'benefit' => self::$totalBenefits,
//            'cost' => self::$totalCosts,
//            'ranking' => self::getRank()
//        ];
//    }
//
//    public static function calculateAggregateScores(): void
//    {
//        $data = self::getBenefitsCosts();
//
//        foreach ($data["alternatives"] as $alternativeId => $alternativeValue) {
//            self::create([
//                'alternative_id' => $alternativeId,
//                'value' => $data['benefit'][$alternativeId] - $data['cost'][$alternativeId],
//            ]);
//        }
//    }
//
//    static function isBenefit($criterionId): bool
//    {
//        static $criteriaTypes = [];
//
//        if (!array_key_exists($criterionId, $criteriaTypes)) {
//            $criterionType = Criterion::find($criterionId)->type;
//            $criteriaTypes[$criterionId] = $criterionType;
//        }
//
//        return $criteriaTypes[$criterionId] == 'benefit';
//    }
//
//    static function getRank(): array
//    {
//        $data = AggregateScore::all()->toArray();
//
//        $ranking = [];
//        foreach ($data as $rank) {
//            $ranking[] = $rank["value"];
//        }
//
//        $collection = collect($ranking);
//
//        $sorted = $collection->sortDesc();
//
//        $ranked = $sorted->values()->map(function ($value, $index) {
//            return ['value' => $value, 'rank' => $index + 1];
//        });
//
//        $result = [];
//        foreach ($ranking as $i => $val) {
//           foreach($ranked as $val2) {
//               if($val == $val2["value"]) {
//                   $result[$i + 1] = $val2["rank"];
//                   break;
//               }
//           }
//        }
//        return $result;
//    }
//}
