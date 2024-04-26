<?php

namespace App\Http\Controllers\Admin\Export;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Export\ExportDomResource;
use App\Modules\Membership\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportDomController extends Controller
{
    public function export()
    {
        $users = User::all();

        $userData = ExportDomResource::collection($users);

        $pdf = Pdf::loadView('tableView', [
            'users' => $userData,
        ]);

        return $pdf->stream('table.pdf');
    }

    public function exportTest()
    {
        $pdf = Pdf::loadView('test');

        return $pdf->stream('test.pdf');
    }
}
