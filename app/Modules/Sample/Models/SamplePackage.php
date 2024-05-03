<?php

namespace App\Modules\Sample\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SamplePackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'hour',
        'minute',
        'price',
        'sort',
    ];

    public function sampleOrders(): HasMany
    {
        return $this->hasMany(SampleOrder::class, 'package_id', 'id');
    }
}
