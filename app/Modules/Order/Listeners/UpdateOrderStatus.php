<?php

namespace App\Modules\Order\Listeners;

use App\Modules\Order\Enums\OrderStatusEnum;
use App\Modules\Order\Events\WarrantyAtOrderItemUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateOrderStatus
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WarrantyAtOrderItemUpdated $event): void
    {
        $order = $event->order;
        $order->status = OrderStatusEnum::WARRANTY_PERIOD;
        $order->save();

        Log::info('berhasil update status');
        // Log::info(`Successfully updated the status for order id => {$order->id}`);
    }
}
