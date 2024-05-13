<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Modules\Order\Events\WarrantyAtOrderItemUpdated;
use App\Modules\Order\Models\Order;
use App\Modules\Order\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
    public function update()
    {
        $orderItem = OrderItem::query()
            ->with('order')
            ->whereNull('warranty_at')->first();

        DB::transaction(function () use ($orderItem) {
            $orderItem->update([
                'warranty_at' => now()->addDays(5),
            ]);
        });
    }
}
