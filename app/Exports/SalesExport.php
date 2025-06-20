<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class SalesExport implements FromCollection, WithHeadings, WithStyles, WithDefaultStyles, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $from, $to;

    public function __construct($from = null, $to = null)
    {
        $this->from = $from;
        $this->to = $to;
    }


    public function collection()
    {
        return Sale::select('invoice_number', 'total', 'created_at')
            ->when($this->from, fn($q) => $q->whereDate('created_at', '>=', $this->from))
            ->when($this->to, fn($q) => $q->whereDate('created_at', '<=', $this->to))
            ->get();
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 10,
            'C' => 27,
        ];
    }

    public function headings(): array
    {
        return ['Invoice Number', 'Total', 'Tanggal'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true, 'color' => ['argb' => Color::COLOR_WHITE]]],
        ];
    }

    public function defaultStyles(Style $defaultStyle)
    {

        return [
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['argb' => Color::COLOR_BLUE],
            ],
        ];
    }
}
