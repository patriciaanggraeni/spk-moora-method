<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 * @property mixed $id
 */
class Alternative extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public $timestamps = false;

    public function decisionMatrices(): HasMany
    {
        return $this->hasMany(DecisionMatrix::class, 'alternative_id');
    }
}
