<?php

namespace App\Modules\Sample\Exports;

use App\Modules\Sample\Models\SampleOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SampleOrderExportByQuery implements
    FromQuery,
    // ShouldAutoSize,
    // ShouldQueue,
    // WithCustomChunkSize,
    WithHeadings,
    WithMapping
// WithStyles
{
    use Exportable
        // Queueable
    ;

    public function __construct(public $query)
    {
        //do something
    }

    public function query()
    {
        // ini_set('memory_limit', '64M');

        return $this->query;

        // return SampleOrder::query()->with([
        //     'samplePackage:id,price,hour,minute',
        //     'sampleMember:id,name,phone,gender,birth_date,is_vip',
        //     'sampleTherapist:id,name,alias_name,gender,address,birth_date,rating,trainer',
        //     'sampleOrderStatus:id,status'
        // ]);


        // dd(
        //     $test[9260]->id,
        //     $test[9260]->order_id,
        //     $test[9260]->payment_type,
        //     $test[9260]->duration,
        //     $test[9260]->price,
        //     $test[9260]->start_time,
        //     $test[9260]->end_time,
        //     $test[9260]->note,
        //     $test[9260]->platform,
        // );
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Payment Type',
            'Duration',
            'Price',
            'Start Time',
            'End Time',
            'Note',
            'Platform',
            'Package Price',
            'Package Hour',
            'Package Minute',
            'Member Name',
            'Member Phone',
            'Member Gender',
            'Member Birth Date',
            'Member Vip',
            'Therapist Name',
            'Therapist Alias Name',
            'Therapist Gender',
            'Therapist Address',
            'Therapist Birth Date',
            'Therapist Rating',
            'Therapist Trainer',
            'Status',
        ];
    }

    public function map($order): array
    {
        return [
            $order->order_id,
            // $order->payment_type,
            // $order->duration,
            // $order->price,
            // $order->start_time,
            // $order->end_time,
            // $order->formatted_note,
            // $order->platform,
            // $order->samplePackage->price,
            // $order->samplePackage->hour,
            // $order->samplePackage->minute,
            // $order->sampleMember->name,
            // $order->sampleMember->phone,
            // $order->sampleMember->gender,
            // $order->sampleMember?->birth_date,
            // $order->sampleMember->is_vip,
            // $order->sampleTherapist?->name,
            // $order->sampleTherapist?->alias_name,
            // $order->sampleTherapist?->gender,
            // $order->sampleTherapist?->address,
            // $order->sampleTherapist?->birth_date,
            // $order->sampleTherapist?->rating,
            // $order->sampleTherapist?->trainer,
            // $order->sampleOrderStatus->status,
        ];
    }

    // public function chunkSize(): int
    // {
    //     return 100;
    // }

    // public function styles(Worksheet $sheet)
    // {
    //     // $sheet->getStyle('B2')->getFont()->setBold(true);
    // }
}
