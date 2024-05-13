<?php

namespace App\Modules\Order\Models;

use App\Modules\Order\Events\WarrantyAtOrderItemUpdated;
use Database\Factories\OrderItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'name',
        'quantity',
        'price',
        'sub_total',
        'warranty_at',
    ];

    protected $casts = [
        'quantity'  => 'integer',
        'price'     => 'double',
        'sub_total' => 'double',
    ];

    // schema of using event listener
    // public static function boot()
    // {
    //     parent::boot();

    //     static::updated(function ($orderItem) {
    //         event(new WarrantyAtOrderItemUpdated($orderItem->order));
    //     });
    // }

    protected static function newFactory(): OrderItemFactory
    {
        return OrderItemFactory::new();
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
