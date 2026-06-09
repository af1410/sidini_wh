<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class NilaiSumatifExport implements FromArray, WithCustomStartCell, WithEvents, ShouldAutoSize
{
    protected $rows;
    protected $babList;
    protected $tugasPerBab;

    public function __construct($rows, $babList, $tugasPerBab)
    {
        $this->rows = $rows;
        $this->babList = $babList;
        $this->tugasPerBab = $tugasPerBab;
    }

    public function startCell(): string
    {
        return 'A3';
    }
    public function array(): array
    {
        return $this->rows;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet;

                $sheet->mergeCells('A1:A2');
                $sheet->mergeCells('B1:B2');

                $sheet->setCellValue('A1', 'No');
                $sheet->setCellValue('B1', 'Nama');

                $col = 3;

                foreach ($this->babList as $bab) {

                    $jumlahKolom =
                        count($this->tugasPerBab[$bab]) + 3;

                    $startCol =
                        \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);

                    $endCol =
                        \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(
                            $col + $jumlahKolom - 1
                        );

                    $sheet->mergeCells(
                        "{$startCol}1:{$endCol}1"
                    );

                    $sheet->setCellValue(
                        "{$startCol}1",
                        "Bab {$bab}"
                    );

                    foreach ($this->tugasPerBab[$bab] as $tugas) {

                        $sheet->setCellValue(
                            \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col) . '2',
                            'T' . $tugas
                        );

                        $col++;
                    }

                    $sheet->setCellValue(
                        \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col++) . '2',
                        'Tes Tulis'
                    );

                    $sheet->setCellValue(
                        \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col++) . '2',
                        'Kehadiran'
                    );

                    $sheet->setCellValue(
                        \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col++) . '2',
                        'Nilai Bab'
                    );
                }

                $lastColumn =
                    \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col - 1);

                $lastRow =
                    count($this->rows) + 2;

                $sheet->getStyle("A1:{$lastColumn}{$lastRow}")
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                $sheet->getStyle("A1:{$lastColumn}2")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle("A1:{$lastColumn}2")
                    ->getFont()
                    ->setBold(true);
            }
        ];
    }
}
