<?php

namespace App\Http\Controllers\Admin\Sample;

use App\Events\ExportOrderCompleted;
use App\Http\Controllers\Controller;
use App\Jobs\ExportLargeExcel;
use App\Modules\Sample\Exports\SampleOrderExportByCollection;
use App\Modules\Sample\Exports\SampleOrderExportByGenerator;
use App\Modules\Sample\Exports\SampleOrderExportByQuery;
use App\Modules\Sample\Exports\SampleOrderExportByView;
use App\Modules\Sample\Models\SampleOrder;
use App\Modules\Sample\Models\SampleOrderStatus;
use App\Modules\Sample\Models\SamplePackage;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SampleController extends Controller
{
    public function exportExcel()
    {
        // direct download using redis caching driver > 5 minutes ~ 10 minutes
        // using ->lazy() collection
        // return Excel::download(new SampleOrderExportByCollection($orders), 'orders.xlsx');

        // implements ShouldQueue directly on SampleOrderExportByCollection
        // (new SampleOrderExportByCollection($orders))->store('orders.xlsx', 'public');

        // dispatch event to downlaod excel
        // ExportOrderCompleted::dispatch();

        // USING IT or using this code to call your event listener
        event(new ExportOrderCompleted);

        return 'starting export....';
    }
}
