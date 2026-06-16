<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NilaiAkhirExport implements FromArray, WithHeadings
{
    protected $rows;
    protected $babList;

    public function __construct($rows, $babList)
    {
        $this->rows = $rows;
        $this->babList = $babList;
    }

    public function headings(): array
    {
        $header = [
            'NIS',
            'Nama Siswa'
        ];

        foreach ($this->babList as $bab) {
            $header[] = "Bab {$bab}";
        }

        $header[] = 'Rata-rata BAB';
        $header[] = 'PSTS';
        $header[] = 'PSAS';
        $header[] = 'Nilai Akhir';

        return $header;
    }

    public function array(): array
    {
        return $this->rows;
    }
}
