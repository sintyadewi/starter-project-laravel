<?php

namespace App\Modules\Sample\Exports;

use App\Modules\Sample\Models\SampleOrder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SampleOrderExportByCollection implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping, WithStyles
{
    use Exportable;

    public function __construct()
    {
        //do something
    }

    public function collection()
    {
        return SampleOrder::query()->with([
            'samplePackage:id,price',
            'sampleMember:id,name,phone',
            'sampleTherapist:id,name',
            'sampleOrderStatus:id,status'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Duration',
            'Price',
            'Member Name',
            'Member Phone',
            'Therapist',
            'Status',
        ];
    }

    public function map($order): array
    {
        return [
            $order->order_id,
            $order->duration,
            $order->samplePackage->price,
            $order->sampleMember->name,
            $order->sampleMember->phone,
            $order->sampleTherapist?->name,
            $order->sampleOrderStatus->status,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // $sheet->getStyle('B2')->getFont()->setBold(true);
    }
}
