<?php

namespace App\Modules\Order\Models;

use App\Modules\Order\Enums\OrderStatusEnum;
use Database\Factories\OrderFactory;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_number',
        'total',
        'status'
    ];

    protected $casts = [
        'total'  => 'float',
        'status' => OrderStatusEnum::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_number = 'ORD-' . Str::random(32); // Example order number format
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['total', 'status'])
            ->useLogName('order_activity')
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}");
    }

    protected static function newFactory(): OrderFactory
    {
        return OrderFactory::new();
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function whereStatus(OrderStatusEnum $status): Builder
    {
        return $this->where('status', $status);
    }
}
