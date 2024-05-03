<?php

namespace App\Modules\Sample\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SampleOrderStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function sampleOrders(): HasMany
    {
        return $this->hasMany(SampleOrder::class, 'status_id', 'id');
    }
}
