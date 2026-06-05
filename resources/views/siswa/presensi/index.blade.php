@extends('siswa.layouts.app')

@section('title', 'Presensi Saya')

@push('styles')
    <style>
        .calendar-table th,
        .calendar-table td {
            min-width: 120px;
            vertical-align: top;
            padding: 0.5rem;
        }

        .calendar-cell {
            min-height: 110px;
        }

        .calendar-cell-outside {
            background-color: #f8f9fa;
        }

        .status-pill {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 0.5rem;
            font-size: 0.8rem;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div
                    class="card-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                    <div>
                        <h4 class="mb-1">Presensi Saya</h4>
                        <p class="text-muted mb-0">Lihat riwayat kehadiran per bulan dan status kehadiran Anda.</p>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <a href="{{ route('siswa.presensi.index', ['month' => $currentDate->copy()->subMonth()->month, 'year' => $currentDate->copy()->subMonth()->year]) }}"
                            class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                        <div class="btn btn-light btn-sm">{{ $monthNames[$month - 1] }} {{ $year }}</div>
                        <a href="{{ route('siswa.presensi.index', ['month' => $currentDate->copy()->addMonth()->month, 'year' => $currentDate->copy()->addMonth()->year]) }}"
                            class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form class="row gy-2 gx-2 align-items-end mb-4" method="GET"
                        action="{{ route('siswa.presensi.index') }}">
                        <div class="col-auto">
                            <label class="form-label mb-1">Bulan</label>
                            <select class="form-select" name="month">
                                @foreach ($monthNames as $index => $label)
                                    <option value="{{ $index + 1 }}" {{ $month === $index + 1 ? 'selected' : '' }}>
                                        {{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <label class="form-label mb-1">Tahun</label>
                            <input type="number" class="form-control" name="year" value="{{ $year }}"
                                min="2020" max="2035">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary">Lihat Bulan</button>
                        </div>
                    </form>

                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <div class="card border-success h-100">
                                <div class="card-body text-center">
                                    <h6 class="card-title">Masuk</h6>
                                    <p class="display-6 mb-0">{{ $hadirCount }}</p>
                                    <p class="text-muted mb-0">Hadir / Terlambat</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-warning h-100">
                                <div class="card-body text-center">
                                    <h6 class="card-title">Sakit</h6>
                                    <p class="display-6 mb-0">{{ $sakitCount }}</p>
                                    <p class="text-muted mb-0">Hari sakit</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-warning h-100">
                                <div class="card-body text-center">
                                    <h6 class="card-title">Izin</h6>
                                    <p class="display-6 mb-0">{{ $izinCount }}</p>
                                    <p class="text-muted mb-0">Hari izin</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-danger h-100">
                                <div class="card-body text-center">
                                    <h6 class="card-title">Alpha / Lainnya</h6>
                                    <p class="display-6 mb-0">{{ $redCount }}</p>
                                    <p class="text-muted mb-0">Tidak masuk / status lain</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered calendar-table mb-0">
                            <thead class="table-light text-center align-middle">
                                <tr>
                                    @foreach ($weekDays as $weekday)
                                        <th>{{ $weekday }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($calendar as $week)
                                    <tr>
                                        @foreach ($week as $day)
                                            @php
                                                $status = $day['status'];
                                                $cellClass = 'calendar-cell';

                                                if (!$day['inMonth']) {
                                                    $cellClass .= ' calendar-cell-outside';
                                                } elseif (in_array($status, ['Hadir', 'Terlambat'])) {
                                                    $cellClass .= ' bg-success text-white';
                                                } elseif (in_array($status, ['Sakit', 'Izin'])) {
                                                    $cellClass .= ' bg-warning text-dark';
                                                } else {
                                                    $cellClass .= ' bg-danger text-white';
                                                }
                                            @endphp
                                            <td class="{{ $cellClass }}">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <strong>{{ $day['date']->format('j') }}</strong>
                                                    </div>
                                                    @if ($day['inMonth'])
                                                        <small>{{ $day['date']->translatedFormat('D') }}</small>
                                                    @endif
                                                </div>

                                                @if ($day['inMonth'])
                                                    <div class="small">
                                                        @if ($status)
                                                            <span
                                                                class="status-pill {{ in_array($status, ['Hadir', 'Terlambat']) ? 'bg-success text-white' : (in_array($status, ['Sakit', 'Izin']) ? 'bg-warning text-dark' : 'bg-danger text-white') }}">
                                                                {{ $status }}
                                                            </span>
                                                        @else
                                                            <span class="status-pill bg-danger text-white">Alpha</span>
                                                        @endif
                                                    </div>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
