<?php

namespace App\Http\Controllers\Admin\Export;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Membership\ExportResource;
use App\Modules\Membership\Models\User;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
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

        // download the pdf 
        // return $pdf->download('table.pdf');
    }
}
