<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Order\OrderActivityResource;
use App\Modules\Membership\Models\User;
use App\Modules\Order\Enums\OrderStatusEnum;
use App\Modules\Order\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class OrderController extends Controller
{
    public function create()
    {
        Order::create([
            'status' => OrderStatusEnum::WAITING_PAYMENT,
        ]);

        // $admin = auth()->user()->id;

        // activity()
        //     ->by($admin)
        //     ->on($order)
        //     ->withProperties(['data1' => 'value1'])
        //     ->event('verified')
        //     ->log('The user has verified the order');
    }

    public function updateStatus()
    {
        $order = Order::find(6);

        DB::transaction(function () use ($order) {
            $order->update([
                'status' => OrderStatusEnum::COMPLETED,
            ]);
        });
    }

    public function orderActivity()
    {
        $order = Order::find(6);

        $orderActivities = Activity::query()->where([
            ['subject_id', $order->id],
            ['subject_type', $order->getMorphClass()]
        ])->get();

        return OrderActivityResource::collection($orderActivities);
    }
}
