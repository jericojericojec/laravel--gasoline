<?php

namespace App\Exports;

use App\tbl_transactions;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class TransactionsExport implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting
{
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return tbl_transactions::all();
    }

    /**
    * @var tbl_transaction $transaction
    */
    public function map($transaction): array
    {
        return [
            $transaction->id,
            $transaction->fuel_type,
            $transaction->price_per_ltr,
            $transaction->purchase_amount,
            $transaction->vat,
            $transaction->total_amount,
            Date::dateTimeToExcel($transaction->created_at),
        ];
    }

    public function headings(): array
    {
        return [
            'Transaction ID',
            'Gasoline Type',
            'Price Per Liter',
            'Purchase Amount',
            'VAT',
            'TOTAL',
            'Date of Transaction'
        ];
    }

    
    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'C' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        ];
    }
}
