<div wire:ignore.self class="offcanvas offcanvas-top border-0" id="offcanvasLaporanKhusus"
    aria-labelledby="offcanvasLaporanKhususLabel" style="min-height:100vh; background:#f8fafc;">
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
            <button type="button"
                class="btn btn-light btn-icon rounded-circle shadow-none"
                data-bs-dismiss="offcanvas">
                <i class="ri-close-line fs-18"></i>
            </button>
        </div>
    </div>
    <div class="offcanvas-body">
        @if($kegiatan)
        <!-- Filter -->
        <div class="row g-4">
            <div class="col-xxl-12 col-lg-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-0 p-4">
                        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                            <div>
                                <h5 class="fw-bold mb-1">{{ $kegiatan->nama_kegiatan }} </h5>
                                <p class="text-muted mb-0">{{ $kegiatan->lokasi_final['tempat'] ?? '-' }}</p>
                            </div>
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="button" class="btn btn-light border rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#ExportMatrix">
                                    <i class="ri-database-2-line me-1 text-secondary"></i>
                                    Export Data
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-top bg-light-subtle">
                        <div class="row g-3 align-items-end">
                            <!-- Cari Kelompok -->
                            <div class="col-xl-12 col-lg-12">
                                <label class="form-label fw-semibold">
                                    Cari Kelompok
                                </label>

                                <div class="search-box">
                                    <input type="text"
                                        class="form-control rounded-3"
                                        placeholder="Ketik nama kelompok..."
                                        wire:model.debounce.500ms="search">

                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <!-- Tabel -->
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
                                            Jumlah Jamaah
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
                                        <th style="min-width: 90px">
                                            %
                                        </th>
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
                                        <td class="fw-bold text-center">
                                            {{ number_format($row['target']) }}
                                        </td>

                                        @foreach($tanggalMatrix as $tanggal)
                                            @php
                                            $data = $row['tanggal'][$tanggal] ?? [
                                            'hadir' => 0,
                                            'persentase' => 0,
                                            ];
                                            @endphp

                                            <td class="fw-bold text-center">
                                                {{ $data['hadir'] }}
                                                {{-- ({{ $data['persentase'] }}%) --}}
                                            </td>
                                        @endforeach
                                        {{-- <td class="fw-bold">
                                            {{ collect($row['persen'])->implode('% / ') }}%
                                        </td> --}}
                                        <td class="fw-bold">
                                            {{ round(collect($row['persen'])->avg()) }}%
                                        </td>
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
                                        <td colspan="2">
                                            JUMLAH
                                        </td>

                                        <td>
                                            {{ number_format($targetTotal) }}
                                        </td>

                                        @foreach($tanggalMatrix as $tanggal)
                                            <td>{{ $totalPerTanggal[$tanggal]['hadir'] ?? 0 }}</td>
                                        @endforeach

                                        <td class="fw-bold">
                                            {{ $persentaseTotal }}%
                                        </td>
                                    </tr>

                                    {{-- <tr>
                                        <td colspan="3">%</td>

                                        @foreach($tanggalMatrix as $tanggal)
                                            <td>{{ $totalPerTanggal[$tanggal]['persentase'] ?? 0 }}%</td>
                                        @endforeach
                                    </tr> --}}

                                    <tr class="table-warning">
                                        <td colspan="3" class="text-center">
                                            <i class="ri-money-dollar-circle-line me-1"></i>
                                            INFAQ
                                        </td>

                                        {{-- <td class="fw-bold">
                                            Rp {{ number_format($totalInfaq, 0, ',', '.') }}
                                        </td> --}}

                                        @foreach($tanggalMatrix as $tanggal)
                                            <td class="fw-bold">
                                                @php $infaq = $totalPerTanggal[$tanggal]['infaq'] ?? 0; @endphp

                                                {{ $infaq ? 'Rp '.number_format($infaq,0,',','.') : '-' }}
                                            </td>
                                        @endforeach

                                        <td></td>
                                    </tr>
                                </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-xxl-12 col-lg-12">
                @livewire('laporan-kegiatan.kegiatan-khusus.attendance', [ 'kegiatanId' => $kegiatanId ])
            </div>
        </div>
        @endif
    </div>
</div>
