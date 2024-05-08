<?php

namespace App\Modules\Sample\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SampleMember extends Model
{
    use HasFactory;

    protected $casts = [
        'phone' => 'string',
        'birth_date' => 'date',
    ];

    protected $appends = [
        'formatted_gender',
        'formatted_is_vip',
    ];

    public function sampleOrders(): HasMany
    {
        return $this->hasMany(SampleOrder::class, 'member_id', 'id');
    }

    public function getFormattedGenderAttribute(): string
    {
        return $this->gender === 1 ? 'Pria' : 'Wanita';
    }

    public function getFormattedIsVipAttribute(): string
    {
        return $this->is_vip === 1 ? 'Ya' : 'Tidak';
    }
}
