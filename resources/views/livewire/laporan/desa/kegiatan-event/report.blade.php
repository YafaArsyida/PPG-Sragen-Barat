<div wire:ignore.self class="offcanvas offcanvas-top border-0" id="offcanvasLaporan"
    aria-labelledby="offcanvasLaporanLabel" style="min-height:100vh; background:#f8fafc;">
    {{-- HEADER --}}
    <div class="offcanvas-header border-bottom bg-white px-4 py-3 shadow-sm">
        <div class="d-flex align-items-center gap-3">
            <div class="avatar-sm">
                <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-18">
                    <i class="ri-file-chart-line">
                    </i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1">
                    Kegiatan Generus Desa {{ $nama_desa }}
                </h5>
                <small>
                    Rekap kehadiran, izin, dan alfa peserta kegiatan generus
                </small>
            </div>
        </div>
        <button type="button" class="btn btn-light btn-icon rounded-circle shadow-none" data-bs-dismiss="offcanvas">
            <i class="ri-close-line fs-18">
            </i>
        </button>
    </div>
    {{-- BODY --}}
    <div class="offcanvas-body">
        @if($kegiatan)
        {{-- HEADER --}}
        <div class="text-center mb-2">
            <h5 class="fw-bold mb-1 text-uppercase">
                {{ $kegiatan->nama_kegiatan }}
            </h5>
            <small class="text-muted">
                {{ $kegiatan->lokasi_final['tempat'] ?? '-' }} {{-- {{ $kegiatan->alamat
                }} --}}
            </small>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr class="text-uppercase fw-bold">
                        <th rowspan="2">
                            NO
                        </th>
                        <th rowspan="2">
                            KELOMPOK
                        </th>
                        <th colspan="3">
                            JUMLAH JAMAAH
                        </th>
                        <th colspan="5">
                            KEHADIRAN {{ strtoupper(
                            \App\Http\Controllers\HelperController::formatTanggalIndonesia(
                            $kegiatan->tanggal, 'd F Y' ) ) }}
                        </th>
                    </tr>
                    <tr class="text-uppercase fw-semibold">
                        <th>Putra</th>
                        <th>Putri</th>
                        <th>Jumlah</th>
                        <th>Putra</th>
                        <th>Putri</th>
                        <th>Jumlah</th>
                        <th>%</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laporanRows as $row)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td class="text-start fw-semibold">
                            {{ strtoupper($row['kelompok']) }}
                        </td>
                        <td>
                            {{ $row['target_l'] }}
                        </td>
                        <td>
                            {{ $row['target_p'] }}
                        </td>
                        <td class="fw-bold">
                            {{ $row['target_total'] }}
                        </td>
                        <td>
                            {{ $row['hadir_l'] }}
                        </td>
                        <td>
                            {{ $row['hadir_p'] }}
                        </td>
                        <td class="fw-bold">
                            {{ $row['hadir_total'] }}
                        </td>
                        <td class="fw-bold">
                            {{ $row['presentase'] }}%
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                {{-- FOOTER --}}
                <tfoot class="table-light fw-bold">
                    <tr>
                        <td colspan="2" class="text-center">
                            JUMLAH
                        </td>
                        <td>
                            {{ $grandTotal['target_l'] }}
                        </td>
                        <td>
                            {{ $grandTotal['target_p'] }}
                        </td>
                        <td>
                            {{ $grandTotal['target_total'] }}
                        </td>
                        <td>
                            {{ $grandTotal['hadir_l'] }}
                        </td>
                        <td>
                            {{ $grandTotal['hadir_p'] }}
                        </td>
                        <td>
                            {{ $grandTotal['hadir_total'] }}
                        </td>
                        <td>
                            {{ $grandTotal['target_total'] > 0 ? round(($grandTotal['hadir_total']
                            / $grandTotal['target_total']) * 100) : 0 }}%
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            INFAQ
                        </td>
                        <td colspan="7" class="fw-bold">
                            RP {{ number_format($totalInfaq, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        {{-- CONTENT --}}
        <div class="row g-4">
            {{-- PRESENSI --}}
            <div class="col-xxl-7 col-lg-7">
                @livewire('laporan.desa.kegiatan-event.report.attendance', [ 'kegiatanId' => $kegiatanId ])
            </div>
            {{-- ALFA --}}
            <div class="col-xxl-5 col-lg-5">
                @livewire('laporan.desa.kegiatan-event.report.alfa', [ 'kegiatanId' => $kegiatanId ])
            </div>
        </div>
        @endif
    </div>
</div>