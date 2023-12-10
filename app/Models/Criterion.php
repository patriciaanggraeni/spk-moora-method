<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @method static where(string $string, $id)
 * @method static insert(array[] $criteriaData)
 * @method static find($criterionId)
 * @method static create(array $array)
 * @method static count()
 * @method static whereNotIn(string $string, Collection $pluck)
 */
class Criterion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'weight',
        'type'
    ];
    public $timestamps = false;

    public function decisionMatrices(): HasMany
    {
        return $this->hasMany(DecisionMatrix::class, 'criterion_id');
    }

    public static function toPercentage($value): int|float
    {
        return $value / 100;
    }
}
