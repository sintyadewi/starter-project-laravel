<?php

namespace App\Modules\Sample\Exports;

use App\Modules\Sample\DTOs\SampleOrderDTO;
use App\Modules\Sample\Models\SampleOrder;
use Generator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\LazyCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromGenerator;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class SampleOrderExportByGenerator implements
    FromGenerator
// ShouldAutoSize,
// ShouldQueue,
// WithCustomChunkSize,
// WithHeadings,
// WithMapping,
// WithColumnFormatting
// WithStyles
{
    use Exportable;

    public function __construct()
    {
        //do something
    }

    public function generator(): Generator
    {
        $query = SampleOrder::query()->with([
            'samplePackage:id,price,hour,minute',
            'sampleMember:id,name,phone,gender,birth_date,is_vip',
            'sampleTherapist:id,name,alias_name,gender,address,birth_date,rating,trainer',
            'sampleOrderStatus:id,status'
        ])->cursor();

        foreach ($query as $deal) {
            // Log::channel('export')->info('Exporting deal', ['deal' => $deal->id]) ;
            yield [
                $deal->id,
                $deal->deal_id,
                $deal->dealer_id
            ];
        }
    }

    public function collection()
    {
        // ini_set('memory_limit', '64M');

        return $this->orders;

        // $orders = SampleOrder::query()->with([
        //     'samplePackage:id,price,hour,minute',
        //     'sampleMember:id,name,phone,gender,birth_date,is_vip',
        //     'sampleTherapist:id,name,alias_name,gender,address,birth_date,rating,trainer',
        //     'sampleOrderStatus:id,status'
        // ])->limit(1)->get()->lazy();

        // return $orders;
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
    //         // Date::dateTimeToExcel($order->start_time),
    //         // Date::dateTimeToExcel($order->end_time),
    //         $order->start_time->format('d F Y'),
    //         $order->end_time->format('d F Y'),
    //         $order->formatted_note,
    //         $order->platform,
    //         $order->samplePackage->price,
    //         $order->samplePackage->hour,
    //         $order->samplePackage->minute,
    //         $order->sampleMember->name,
    //         $order->sampleMember->phone,
    //         $order->sampleMember->formatted_gender,
    //         $order->sampleMember?->birth_date->format('Y/m/d'),
    //         $order->sampleMember->formatted_is_vip,
    //         $order->sampleTherapist?->name,
    //         $order->sampleTherapist?->alias_name,
    //         $order->sampleTherapist?->formatted_gender,
    //         $order->sampleTherapist?->address,
    //         $order->sampleTherapist?->birth_date->format('d-m-Y'),
    //         $order->sampleTherapist?->rating,
    //         $order->sampleTherapist?->trainer,
    //         $order->sampleOrderStatus->status,
    //     ];
    // }

    // public function chunkSize(): int
    // {
    //     return 20000;
    // }

    public function columnFormats(): array
    {
        return [
            // 'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'M' => NumberFormat::FORMAT_TEXT,
        ];
    }

    // public function styles(Worksheet $sheet)
    // {
    //     // $sheet->getStyle('B2')->getFont()->setBold(true);
    // }
}
