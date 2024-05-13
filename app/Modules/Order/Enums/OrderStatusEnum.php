<?php

namespace App\Modules\Order\Enums;

enum OrderStatusEnum: string
{
    case COMPLETED = 'completed';
    case IN_PROGRESS = 'in_progress';
    case WAITING_PAYMENT = 'waiting_payment';
    case WARRANTY_PERIOD = 'warranty_period';

    public static function forSeeder(): array
    {
        return $array = [
            self::COMPLETED,
            self::IN_PROGRESS,
            self::WAITING_PAYMENT,
        ];
    }
}
