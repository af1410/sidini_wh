@extends('admin.layouts.app')

@section('title', 'Presensi Siswa')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-1">Presensi Siswa</h4>
                    <p class="text-muted mb-0">Tap kartu siswa untuk mencatat hadir secara otomatis.</p>
                </div>
                <div>
                    <button id="refreshButton" class="btn btn-outline-secondary">Segarkan</button>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Mode Pendeteksian Kartu</label>
                            <input id="scanInput" type="text" autocomplete="off" spellcheck="false" class="form-control"
                                placeholder="Tempelkan kartu siswa di sini" autofocus>
                        </div>
                        <div id="scanStatus" class="alert alert-info mb-0">
                            Cukup tap kartu siswa, sistem akan mendeteksi otomatis tanpa perlu klik input.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-3">Presensi Hari Ini</h6>
                        <p class="mb-1">Tanggal:
                            <strong>{{ \Illuminate\Support\Carbon::parse($tanggal)->format('d M Y') }}</strong>
                        </p>
                        <p class="mb-0">Jumlah siswa: <strong id="totalStudentCount">{{ $siswa->count() }}</strong>,
                            hadir:
                            <strong id="presentCount"
                                data-count="{{ $presensiHariIni->count() }}">{{ $presensiHariIni->count() }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Daftar Siswa</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>UID Kartu</th>
                            <th>Status</th>
                            <th>Waktu Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $index => $item)
                            @php
                                $hadir = $presensiHariIni->has($item->id_siswa)
                                    ? $presensiHariIni->get($item->id_siswa)
                                    : null;
                            @endphp
                            <tr id="row-{{ $item->id_siswa }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nim }}</td>
                                <td>{{ $item->nama_siswa }}</td>
                                <td>{{ $item->dataKelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $item->uid_kartu ?? '-' }}</td>
                                <td class="status-cell">
                                    @if (!$hadir)
                                        <span class="badge bg-secondary">Belum</span>
                                    @elseif ($hadir->status == 'Hadir')
                                        <span class="badge bg-success">Hadir</span>
                                    @elseif ($hadir->status == 'Izin')
                                        <span class="badge bg-info">Izin</span>
                                    @elseif ($hadir->status == 'Sakit')
                                        <span class="badge bg-primary">Sakit</span>
                                    @elseif ($hadir->status == 'Alpha')
                                        <span class="badge bg-danger">Alpha</span>
                                    @else
                                        <span class="badge bg-warning">Terlambat</span>
                                    @endif
                                </td>
                                <td class="time-cell">
                                    {{ $hadir->waktu_masuk ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const scanInput = document.getElementById('scanInput');
                const scanStatus = document.getElementById('scanStatus');
                const refreshButton = document.getElementById('refreshButton');
                const scanUrl = '{{ route('admin.presensi.scan') }}';

                function setStatus(message, type = 'info') {
                    scanStatus.textContent = message;
                    scanStatus.className = 'alert alert-' + type + ' mb-0';
                }

                function updateRow(data) {
                    const row = document.getElementById('row-' + data.id_siswa);
                    if (!row) {
                        return;
                    }
                    const statusCell = row.querySelector('.status-cell');
                    const timeCell = row.querySelector('.time-cell');
                    const currentStatus = statusCell.textContent.trim();

                    statusCell.innerHTML = '<span class="badge bg-success">' + data.status + '</span>';
                    timeCell.textContent = data.waktu_masuk || '-';

                    if (currentStatus !== 'Hadir') {
                        const presentCount = document.getElementById('presentCount');
                        const count = parseInt(presentCount.dataset.count, 10) || 0;
                        presentCount.dataset.count = count + 1;
                        presentCount.textContent = count + 1;
                    }
                }

                let scanBuffer = '';
                let scanTimer = null;
                const bufferTimeout = 300;

                function resetScanBuffer() {
                    scanBuffer = '';
                    if (scanInput) {
                        scanInput.value = '';
                    }
                }

                async function submitScan(uid) {
                    try {
                        const response = await fetch(scanUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    ?.getAttribute('content') || document.querySelector(
                                        'input[name="_token"]')?.value,
                            },
                            body: JSON.stringify({
                                uid_kartu: uid
                            }),
                        });
                        let result;
                        const text = await response.text();
                        try {
                            result = JSON.parse(text);
                        } catch (parseError) {
                            throw new Error('Server tidak merespons JSON: ' + text);
                        }

                        if (response.ok && result.success) {
                            setStatus(result.message, 'success');
                            updateRow(result.data);
                        } else if (result && result.message) {
                            setStatus(result.message, 'warning');
                        } else {
                            setStatus('Gagal memproses scan: ' + response.statusText, 'danger');
                        }
                    } catch (error) {
                        setStatus('Gagal memproses scan: ' + error.message, 'danger');
                    }
                }

                function handleScannerKey(event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        const uid = scanBuffer.trim() || (scanInput ? scanInput.value.trim() : '');
                        if (!uid) {
                            setStatus('UID kartu kosong, ulangi tap kartu.', 'warning');
                            resetScanBuffer();
                            return;
                        }
                        submitScan(uid);
                        resetScanBuffer();
                        return;
                    }

                    if (event.key.length === 1) {
                        scanBuffer += event.key;
                        if (scanInput) {
                            scanInput.value = scanBuffer;
                        }
                        clearTimeout(scanTimer);
                        scanTimer = setTimeout(resetScanBuffer, bufferTimeout);
                    }
                }

                if (scanInput) {
                    scanInput.addEventListener('keydown', handleScannerKey);
                    scanInput.addEventListener('blur', function() {
                        setTimeout(function() {
                            scanInput.focus();
                        }, 100);
                    });
                }

                document.addEventListener('keydown', function(event) {
                    if (event.target && (event.target.tagName === 'INPUT' || event.target.isContentEditable)) {
                        return;
                    }
                    handleScannerKey(event);
                });

                refreshButton.addEventListener('click', function() {
                    window.location.reload();
                });

                scanInput.focus();
            });
        </script>
    @endpush
@endsection
