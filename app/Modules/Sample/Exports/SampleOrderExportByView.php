<?php

namespace App\Modules\Sample\Exports;

use App\Modules\Sample\Models\SampleOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SampleOrderExportByView implements
    FromView,
    ShouldQueue,
    // ShouldAutoSize,
    WithCustomChunkSize
// WithHeadings,
// WithMapping
// WithStyles
{
    use Exportable, Queueable;

    public function __construct()
    {
        //do something
    }

    public function view(): View
    {
        ini_set('memory_limit', '64M');

        $orders = SampleOrder::query()->with([
            'samplePackage:id,price,hour,minute',
            'sampleMember:id,name,phone,gender,birth_date,is_vip',
            'sampleTherapist:id,name,alias_name,gender,address,birth_date,rating,trainer',
            'sampleOrderStatus:id,status'
        ])->get();

        // dd(count($orders));

        // dd($orders[0]['id']);

        return view('pages.admin.export.order', [
            'orders' => $orders,
        ]);
    }

    // public function headings(): array
    // {
    //     return [
    //         'Order ID',
    //         'Payment Type',
    //         'Duration',
    //         'Price',
    //         'Start Time',
    //         'End Time',
    //         'Note',
    //         'Platform',
    //         'Package Price',
    //         'Package Hour',
    //         'Package Minute',
    //         'Member Name',
    //         'Member Phone',
    //         'Member Gender',
    //         'Member Birth Date',
    //         'Member Vip',
    //         'Therapist Name',
    //         'Therapist Alias Name',
    //         'Therapist Gender',
    //         'Therapist Address',
    //         'Therapist Birth Date',
    //         'Therapist Rating',
    //         'Therapist Trainer',
    //         'Status',
    //     ];
    // }

    // public function map($order): array
    // {
    //     return [
    //         $order->order_id,
    //         $order->payment_type,
    //         $order->duration,
    //         $order->price,
    //         $order->start_time,
    //         $order->end_time,
    //         $order->formatted_note,
    //         $order->platform,
    //         $order->samplePackage->price,
    //         $order->samplePackage->hour,
    //         $order->samplePackage->minute,
    //         $order->sampleMember->name,
    //         $order->sampleMember->phone,
    //         $order->sampleMember->gender,
    //         $order->sampleMember?->birth_date,
    //         $order->sampleMember->is_vip,
    //         $order->sampleTherapist?->name,
    //         $order->sampleTherapist?->alias_name,
    //         $order->sampleTherapist?->gender,
    //         $order->sampleTherapist?->address,
    //         $order->sampleTherapist?->birth_date,
    //         $order->sampleTherapist?->rating,
    //         $order->sampleTherapist?->trainer,
    //         $order->sampleOrderStatus->status,
    //     ];
    // }

    public function chunkSize(): int
    {
        // chunk disini ga ngaruh
        return 5000;
    }

    // public function styles(Worksheet $sheet)
    // {
    //     // $sheet->getStyle('B2')->getFont()->setBold(true);
    // }
}
