<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Modules\Membership\Exports\UsersExport;
use App\Modules\Membership\Filters\UserFilter;
use App\Modules\Membership\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
