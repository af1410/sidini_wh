<?php

namespace Database\Seeders;

use App\Models\GuruMapel;
use Illuminate\Database\Seeder;

class GuruMapelSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_guru' => 11, 'id_mapel' => 'MM2627001'],
            ['id_guru' => 12, 'id_mapel' => 'MM2627012'],
            ['id_guru' => 13, 'id_mapel' => 'MM2627013'],
            ['id_guru' => 14, 'id_mapel' => 'MM2627014'],
            ['id_guru' => 15, 'id_mapel' => 'MM2627015'],
            ['id_guru' => 16, 'id_mapel' => 'MM2627016'],
            ['id_guru' => 17, 'id_mapel' => 'MU2627001'],
            ['id_guru' => 18, 'id_mapel' => 'MU2627002'],
            ['id_guru' => 19, 'id_mapel' => 'MU2627003'],
            ['id_guru' => 20, 'id_mapel' => 'MU2627004'],
            ['id_guru' => 21, 'id_mapel' => 'MU2627005'],
            ['id_guru' => 22, 'id_mapel' => 'MU2627006'],
            ['id_guru' => 23, 'id_mapel' => 'MU2627007'],
            ['id_guru' => 24, 'id_mapel' => 'MU2627008'],
            ['id_guru' => 25, 'id_mapel' => 'MU2627009'],
            ['id_guru' => 26, 'id_mapel' => 'MU2627010'],
            ['id_guru' => 27, 'id_mapel' => 'MU2627011'],
        ];
        foreach ($data as $item) {
            GuruMapel::firstOrCreate($item);
        }
    }
}
