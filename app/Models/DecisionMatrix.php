<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $criterionId)
 * @method static create(array $array)
 * @method static distinct(string $string)
 */
class DecisionMatrix extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternative_id',
        'criterion_id',
        'value',
    ];
    public $timestamps = false;
}
