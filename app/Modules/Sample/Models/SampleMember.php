<?php

namespace App\Modules\Sample\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SampleMember extends Model
{
    use HasFactory;

    public function sampleOrders(): HasMany
    {
        return $this->hasMany(SampleOrder::class, 'member_id', 'id');
    }
}
