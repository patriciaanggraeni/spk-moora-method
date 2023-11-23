<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Normalization extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternative_id',
        'criterion_id',
        'value',
    ];
}
