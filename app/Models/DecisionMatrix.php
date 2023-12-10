<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function alternative(): BelongsTo
    {
        return $this->belongsTo(Alternative::class, 'alternative_id');
    }

    public function criterion(): BelongsTo
    {
        return $this->belongsTo(Criterion::class, 'criterion_id');
    }
}
