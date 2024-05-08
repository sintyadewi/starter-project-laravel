<?php

namespace App\Http\Controllers\Admin\Sample;

use App\Http\Controllers\Controller;
use App\Jobs\ExportLargeExcel;
use App\Modules\Sample\Exports\SampleOrderExportByCollection;
use App\Modules\Sample\Exports\SampleOrderExportByGenerator;
use App\Modules\Sample\Exports\SampleOrderExportByQuery;
use App\Modules\Sample\Exports\SampleOrderExportByView;
use App\Modules\Sample\Models\SampleOrder;
use App\Modules\Sample\Models\SampleOrderStatus;
use App\Modules\Sample\Models\SamplePackage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SampleController extends Controller
{
    public function exportExcel()
    {
        $orders = SampleOrder::query()->with([
            'samplePackage:id,price,hour,minute',
            'sampleMember:id,name,phone,gender,birth_date,is_vip',
            'sampleTherapist:id,name,alias_name,gender,address,birth_date,rating,trainer',
            'sampleOrderStatus:id,status'
        ])->lazy();

        return Excel::download(new SampleOrderExportByCollection($orders), 'orders.xlsx');

        // return Excel::queue(new SampleOrderExportByCollection, 'test.xlsx');
        // return Excel::download(new SampleOrderExportByView, 'test.xlsx');

    }
}
