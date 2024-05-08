<?php

namespace App\Modules\Sample\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SampleTherapist extends Model
{
    use HasFactory;

    protected $casts = [
        'phone' => 'string',
        'birth_date' => 'date',
    ];

    protected $appends = [
        'formatted_gender',
    ];

    public function sampleOrders(): HasMany
    {
        return $this->hasMany(SampleOrder::class, 'therapist_id', 'id');
    }

    public function getFormattedGenderAttribute(): string
    {
        return $this->gender === 'm' ? 'Male' : 'Female';
    }
}
