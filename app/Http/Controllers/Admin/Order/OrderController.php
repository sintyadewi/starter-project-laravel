<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Modules\Membership\Models\User;
use App\Modules\Order\Enums\OrderStatusEnum;
use App\Modules\Order\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        $order = Order::create([
            'status' => OrderStatusEnum::WAITING_PAYMENT,
        ]);

        $user = User::find(2);

        activity()
            ->by($user)
            ->on($order)
            ->withProperties(['data1' => 'value1'])
            ->event('verified')
            ->log('The user has verified the order');
    }
}
