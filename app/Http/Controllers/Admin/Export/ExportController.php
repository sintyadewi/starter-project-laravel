<?php

namespace App\Http\Controllers\Admin\Export;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Membership\ExportResource;
use App\Modules\Membership\Models\User;
use PDF;

class ExportController extends Controller
{
    public function export()
    {
        $users = User::all();

        $userData = ExportResource::collection($users);

        $pdf = PDF::loadView('tableView', [
            'users' => $userData,
        ]);

        // show the result on browser
        return $pdf->stream('table.pdf');
        // or using this line
        // return $pdf->inline('table.pdf');

        // download the pdf 
        // return $pdf->download('table.pdf');
    }

    public function exportTest()
    {
        return PDF::loadView('caroline')->inline('caroline.pdf');
    }
}
