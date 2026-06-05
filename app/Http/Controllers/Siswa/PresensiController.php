<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PresensiController extends Controller
{
    public function index(Request $request)
    {
        $siswa = Auth::guard('siswa')->user();

        $year = intval($request->query('year', now()->year));
        $month = intval($request->query('month', now()->month));

        if ($month < 1 || $month > 12) {
            $month = now()->month;
        }

        if ($year < 2000 || $year > now()->year + 5) {
            $year = now()->year;
        }

        $currentDate = Carbon::createFromDate($year, $month, 1);
        $startOfMonth = $currentDate->copy()->startOfMonth();
        $endOfMonth = $currentDate->copy()->endOfMonth();
        $startOfCalendar = $startOfMonth->copy()->startOfWeek(Carbon::MONDAY);
        $endOfCalendar = $endOfMonth->copy()->endOfWeek(Carbon::SUNDAY);

        $presensiRecords = Presensi::where('id_siswa', $siswa->id_siswa)
            ->whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->get()
            ->keyBy(fn($item) => $item->tanggal->format('Y-m-d'));

        $calendar = [];
        $current = $startOfCalendar->copy();

        while ($current->lte($endOfCalendar)) {
            $week = [];
            for ($dayIndex = 0; $dayIndex < 7; $dayIndex++) {
                $key = $current->format('Y-m-d');
                $week[] = [
                    'date' => $current->copy(),
                    'inMonth' => $current->month === $month,
                    'status' => $presensiRecords->has($key) ? $presensiRecords->get($key)->status : null,
                ];
                $current->addDay();
            }
            $calendar[] = $week;
        }

        $hadirCount = $presensiRecords->whereIn('status', ['Hadir', 'Terlambat'])->count();
        $sakitCount = $presensiRecords->where('status', 'Sakit')->count();
        $izinCount = $presensiRecords->where('status', 'Izin')->count();
        $totalDays = $endOfMonth->day;
        $redCount = $totalDays - $hadirCount - $sakitCount - $izinCount;

        $monthNames = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];

        $weekDays = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];

        return view('siswa.presensi.index', compact(
            'siswa',
            'calendar',
            'weekDays',
            'currentDate',
            'month',
            'year',
            'monthNames',
            'hadirCount',
            'sakitCount',
            'izinCount',
            'redCount'
        ));
    }
}
