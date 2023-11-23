<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static updateOrCreate(array $array, float[]|int[] $array1)
 */
class DecisionMatrix extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternative_id',
        'criterion_id',
        'value',
    ];
}
