<?php

namespace App\Http\Controllers\Admin\Sample;

use App\Http\Controllers\Controller;
use App\Modules\Sample\Exports\SampleOrderExportByCollection;
use App\Modules\Sample\Models\SampleOrder;
use App\Modules\Sample\Models\SampleOrderStatus;
use App\Modules\Sample\Models\SamplePackage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SampleController extends Controller
{
    // public function exportByView(): BinaryFileResponse
    // {
    //     return Excel::download(new UserExportByView, 'userView.xlsx');
    // }

    // public function exportByQuery(): BinaryFileResponse
    // {
    //     return Excel::download(new UserExportByQuery, 'userQuery.xlsx');
    // }

    public function orderCollection(): BinaryFileResponse
    {
        return Excel::download(new SampleOrderExportByCollection, 'order-collection.xlsx');
    }
}
