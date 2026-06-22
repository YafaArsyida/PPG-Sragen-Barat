<div wire:ignore.self class="offcanvas offcanvas-top border-0" id="offcanvasLaporan"
    aria-labelledby="offcanvasLaporanLabel" style="min-height:100vh; background:#f8fafc;">
    <div class="offcanvas-header border-bottom bg-white px-4 py-3 shadow-sm">

        <div class="d-flex justify-content-between align-items-start w-100">
            <!-- Kiri -->
            <div class="d-flex align-items-center gap-3">
                <div class="avatar-sm">
                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-18">
                        <i class="ri-file-chart-line"></i>
                    </div>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">
                        Kegiatan Generus Desa {{ $nama_desa }}
                    </h5>
                    <small class="text-muted">
                        Rekap kehadiran, izin, dan alfa peserta kegiatan generus
                    </small>
                </div>
            </div>

            <!-- Kanan -->
            <div class="d-flex align-items-center gap-2 flex-shrink-0">
                <div>
                    <div class="d-flex align-items-center gap-2">
                        <input type="date" class="form-control rounded-3" wire:model="startDate" value="{{ $startDate }}">
                        <div class="text-muted flex-shrink-0">
                            —
                        </div>
                        <input type="date" class="form-control rounded-3" wire:model="endDate" value="{{ $endDate }}">
                        <button type="button" class="btn btn-soft-secondary btn-icon rounded-circle flex-shrink-0"
                            wire:click="resetTanggal" title="Reset Tanggal">
                            <i class="ri-refresh-line">
                            </i>
                        </button>
                    </div>
                </div>

                <button type="button"
                    class="btn btn-light btn-icon rounded-circle shadow-none"
                    data-bs-dismiss="offcanvas">
                    <i class="ri-close-line fs-18"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="offcanvas-body">
        @if($kegiatan)
        <div class="text-center mb-2">
            <h5 class="fw-bold mb-1 text-uppercase">{{ $kegiatan->nama_kegiatan }}</h5>
            <small class="text-muted">
                {{ $kegiatan->lokasi_final['tempat'] ?? '-' }}
            </small>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-nowrap text-center align-middle">

                <thead class="table-light">

                    <tr class="text-uppercase fw-bold">

                        <th style="width: 60px">
                            No
                        </th>

                        <th>
                            Kelompok
                        </th>
                        <th style="min-width: 100px">
                            Jumlah
                        </th>

                        @foreach($tanggalMatrix as $tanggal)
                        <th>

                            <div class="fw-semibold">
                                {{ \App\Http\Controllers\HelperController::formatTanggalIndonesia($tanggal, 'l') }}
                            </div>

                            <small class="text-muted">
                                {{ \App\Http\Controllers\HelperController::formatTanggalIndonesia($tanggal, 'd F Y') }}
                            </small>

                        </th>
                        @endforeach

                    </tr>

                </thead>

                <tbody>

                    @forelse($laporanRows as $row)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td class="text-start">

                            <div class="fw-bold  text-uppercase">
                                {{ $row['kelompok'] }}
                            </div>

                        </td>
                        <td>
                            <div class="fw-bold">
                                {{ number_format($row['target']) }}
                            </div>

                            <small class="text-muted">
                                Jamaah
                            </small>
                        </td>

                        @foreach($tanggalMatrix as $tanggal)

                        @php
                        $data = $row['tanggal'][$tanggal] ?? [
                        'hadir' => 0,
                        'persentase' => 0,
                        ];
                        @endphp

                        <td>

                            <div class="fw-bold">
                                {{ $data['hadir'] }}
                            </div>

                            <small class="text-muted">
                                ({{ $data['persentase'] }}%)
                            </small>

                        </td>

                        @endforeach

                    </tr>

                    @empty

                    <tr>
                        <td colspan="{{ count($tanggalMatrix) + 2 }}">
                            <div class="text-muted py-3">
                                Tidak ada data pada periode ini
                            </div>
                        </td>
                    </tr>

                    @endforelse

                </tbody>

                @if(count($tanggalMatrix))

                <tfoot class="table-light fw-bold">

                    <tr>

                        <td colspan="3">
                            TOTAL
                        </td>

                        @foreach($tanggalMatrix as $tanggal)

                        <td>

                            <div>
                                {{ $totalPerTanggal[$tanggal]['hadir'] ?? 0 }}
                            </div>

                            <small>
                                ({{ $totalPerTanggal[$tanggal]['persentase'] ?? 0 }}%)
                            </small>

                        </td>

                        @endforeach

                    </tr>

                    <tr class="table-warning">

                        <td colspan="3">
                            <i class="ri-money-dollar-circle-line me-1"></i>
                            INFAQ
                        </td>

                        @foreach($tanggalMatrix as $tanggal)
                        <td>
                            Rp {{ number_format($totalPerTanggal[$tanggal]['infaq'] ?? 0, 0, ',', '.') }}
                        </td>
                        @endforeach
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
        <div class="row g-4">
            <div class="col-xxl-12 col-lg-12">
                @livewire('operasional.kegiatan-rutin.attendance', ['kegiatanId' => $kegiatanId])
            </div>
        </div>
        @endif
    </div>
</div>
