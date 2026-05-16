<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Siswa;
use Illuminate\Support\Facades\DB;

$siswa = Siswa::first();
if (!$siswa) {
    echo "No Siswa found\n";
    exit(1);
}
$date = now()->toDateString();
$exists = DB::table('presensi')->where('id_siswa', $siswa->id_siswa)->where('tanggal', $date)->exists();
if ($exists) {
    echo "Presensi already exists for siswa id={$siswa->id_siswa} on {$date}\n";
    exit(0);
}
$status = now()->greaterThan(now()->copy()->setTime(7, 0, 0)) ? 'Terlambat' : 'Hadir';
// use model primary key field name
$inserted = DB::table('presensi')->insert([
    'id_siswa' => $siswa->id_siswa,
    'tanggal' => $date,
    'waktu_masuk' => now()->toTimeString(),
    'status' => $status,
    'created_at' => now(),
    'updated_at' => now()
]);
if ($inserted) {
    echo "Inserted presensi for siswa id={$siswa->id_siswa} status={$status}\n";
} else {
    echo "Failed to insert presensi\n";
}
