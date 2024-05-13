<?php

namespace App\Listeners;

use App\Events\ExportOrderCompleted;
use App\Modules\Sample\Exports\SampleOrderExportByCollection;
use App\Modules\Sample\Exports\SampleOrderExportByQuery;
use App\Modules\Sample\Models\SampleOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Throwable;

class DownloadExportOrder implements ShouldQueue
{
    use InteractsWithQueue;

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
    public function handle(ExportOrderCompleted $event)
    {
        $orders = SampleOrder::query()->with([
            'samplePackage:id,price,hour,minute',
            'sampleMember:id,name,phone,gender,birth_date,is_vip',
            'sampleTherapist:id,name,alias_name,gender,address,birth_date,rating,trainer',
            'sampleOrderStatus:id,status'
        ])->limit(10)->get();

        // memory limit error using collection
        (new SampleOrderExportByCollection($orders))->store('orders.xlsx', 'public');

        Log::info('exported done');
        // return Redirect::to(route('download'));
    }

    public function failed(ExportOrderCompleted $event, Throwable $exception): void
    {
        Log::info($exception);
    }
}
