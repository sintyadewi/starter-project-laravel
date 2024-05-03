<?php

namespace App\Modules\Membership\Exports;

use App\Modules\Membership\Filters\UserFilter;
use App\Modules\Membership\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserExportByCollection implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles
{
    use Exportable;

    public function __construct()
    {
        //do something
    }

    public function collection()
    {
        return User::applyFilter(UserFilter::class)->get();
    }

    public function headings(): array
    {
        return [
            'No.',
            'Nama',
            'Email',
            'Verifikasi Email',
            'Created at',
            'Updated at',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('B2')->getFont()->setBold(true);
    }
}
