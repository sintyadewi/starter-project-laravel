<?php

namespace App\Modules\Membership\Exports;

use App\Modules\Membership\Filters\UserFilter;
use App\Modules\Membership\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $users = User::applyFilter(UserFilter::class)->get();

        return view('pages.admin.export.user', [
            'users' => $users,
        ]);
    }
}
