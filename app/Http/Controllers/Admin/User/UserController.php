<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Modules\Membership\Exports\UserExportByCollection;
use App\Modules\Membership\Exports\UserExportByQuery;
use App\Modules\Membership\Exports\UserExportByView;
use App\Modules\Membership\Filters\UserFilter;
use App\Modules\Membership\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // using old timedoor/filter package
        // $users = User::filter($request)->get();

        // using latest timedoor/laravel-filter package
        $users = User::applyFilter(UserFilter::class, [
            'exclude' => ['email']
        ])->get();

        dd($users);
    }

    public function exportByView(): BinaryFileResponse
    {
        return Excel::download(new UserExportByView, 'userView.xlsx');
    }

    public function exportByQuery(): BinaryFileResponse
    {
        return Excel::download(new UserExportByQuery, 'userQuery.xlsx');
    }

    public function exportByCollection(): BinaryFileResponse
    {
        return Excel::download(new UserExportByCollection, 'userCollection.xlsx');
    }
}
