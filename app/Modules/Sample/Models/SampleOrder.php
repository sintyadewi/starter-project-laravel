<?php

namespace App\Modules\Sample\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class SampleOrder extends Model
{
    use HasFactory;

    protected $appends = [
        'formatted_note',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function sampleOrderStatus(): BelongsTo
    {
        return $this->belongsTo(SampleOrderStatus::class, 'status_id', 'id');
    }

    public function sampleMember(): BelongsTo
    {
        return $this->belongsTo(SampleMember::class, 'member_id', 'id');
    }

    public function samplePackage(): BelongsTo
    {
        return $this->belongsTo(SamplePackage::class, 'package_id', 'id');
    }

    public function sampleTherapist(): BelongsTo
    {
        return $this->belongsTo(SampleTherapist::class, 'therapist_id', 'id');
    }

    public function getFormattedNoteAttribute(): ?string
    {
        return Str::replaceFirst('=', '', $this->note);
    }
}
