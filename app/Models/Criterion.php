<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $id)
 * @method static insert(array[] $criteriaData)
 * @method static find($criterionId)
 * @method static create(array $array)
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

    public static function toPercentage($value): int|float
    {
        return $value / 100;
    }
}
