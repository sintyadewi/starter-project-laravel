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
        $users = User::query()->limit(5)->get();

        return PDF::loadView('caroline', [
            'users' => $users,
        ])
            ->setPaper('a4')
            ->setOrientation('portrait')
            // ->setOption('margin-bottom', 0)
            ->setOption('zoom', 0.8)
            // ->zoom(0.5)
            ->inline('caroline.pdf');
    }
}
