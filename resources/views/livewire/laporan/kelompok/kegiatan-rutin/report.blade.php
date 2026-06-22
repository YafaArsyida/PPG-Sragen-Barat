<div wire:ignore.self class="offcanvas offcanvas-top" id="offcanvasLaporan" aria-labelledby="offcanvasLaporanLabel"
    style="min-height:100vh;">

    {{-- HEADER --}}
    <div class="offcanvas-header border-bottom bg-white">
        <div>
            <h5 class="offcanvas-title fw-bold mb-1" id="offcanvasLaporanLabel">
                <i class="ri-file-chart-line me-1 text-success"></i>
                Laporan Kehadiran Generus
            </h5>

            <div class="text-muted fs-13">
                Kelompok {{ $nama_kelompok }}
                <span class="mx-1">•</span>
                Desa {{ $nama_desa }}
            </div>
        </div>

        <button type="button" class="btn-close text-reset shadow-none" data-bs-dismiss="offcanvas"></button>
    </div>

    {{-- BODY --}}
    <div class="offcanvas-body bg-light-subtle">

        @if($kegiatan)

        {{-- SUMMARY --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3">

            {{-- TOP HEADER --}}
            <div class="card-body border-bottom bg-white">

                {{-- TITLE --}}
                <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">

                    <div>

                        <div class="d-flex align-items-center gap-2 mb-2">

                            @if($kegiatan->tipe_kegiatan === 'rutin')
                            <span class="badge bg-soft-primary text-primary">
                                <i class="ri-repeat-line me-1"></i>
                                Kegiatan Rutin
                            </span>
                            @else
                            <span class="badge bg-soft-success text-success">
                                <i class="ri-calendar-event-line me-1"></i>
                                Event
                            </span>
                            @endif

                            @if($kegiatan->jenjang)
                            <span class="badge bg-soft-info text-info">
                                {{ ucfirst($kegiatan->jenjang) }}
                            </span>
                            @endif

                        </div>

                        <h3 class="fw-bold mb-1">
                            {{ $kegiatan->nama_kegiatan }}
                        </h3>

                        @if($kegiatan->deskripsi)
                        <p class="text-muted mb-0">
                            {{ $kegiatan->deskripsi }}
                        </p>
                        @endif

                    </div>

                </div>

                {{-- INFO BAR --}}
                <div class="row g-3 mt-2">

                    {{-- Hari --}}
                    <div class="col-xl-3 col-md-6">
                        <div class="border border-dashed rounded-3 p-3 h-100">

                            <div class="d-flex align-items-center">

                                <div class="avatar-sm me-3">
                                    <div class="avatar-title rounded-circle bg-soft-warning text-warning fs-18">
                                        <i class="ri-repeat-line"></i>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-muted mb-1 fs-12">
                                        Hari Rutin
                                    </p>

                                    <h6 class="mb-0 fw-semibold">

                                        @if($kegiatan->hari_rutin && count($kegiatan->hari_rutin))
                                        {{ collect($kegiatan->hari_rutin)->map(fn($h) => ucfirst($h))->implode(', ') }}
                                        @else
                                        Jadwal Mingguan
                                        @endif

                                    </h6>
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- Waktu --}}
                    <div class="col-xl-3 col-md-6">
                        <div class="border border-dashed rounded-3 p-3 h-100">

                            <div class="d-flex align-items-center">

                                <div class="avatar-sm me-3">
                                    <div class="avatar-title rounded-circle bg-soft-primary text-primary fs-18">
                                        <i class="ri-time-line"></i>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-muted mb-1 fs-12">
                                        Waktu
                                    </p>

                                    <h6 class="mb-0 fw-semibold">
                                        {{ $kegiatan->waktu ?? '-' }}
                                    </h6>
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- Scope --}}
                    <div class="col-xl-3 col-md-6">
                        <div class="border border-dashed rounded-3 p-3 h-100">

                            <div class="d-flex align-items-center">

                                <div class="avatar-sm me-3">
                                    <div class="avatar-title rounded-circle bg-soft-success text-success fs-18">
                                        <i class="ri-focus-3-line"></i>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-muted mb-1 fs-12">
                                        Lingkup
                                    </p>

                                    <h6 class="mb-0 fw-semibold">
                                        {{ ucfirst($kegiatan->scope) }}
                                    </h6>
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- Target --}}
                    <div class="col-xl-3 col-md-6">
                        <div class="border border-dashed rounded-3 p-3 h-100">

                            <div class="d-flex align-items-center">

                                <div class="avatar-sm me-3">
                                    <div class="avatar-title rounded-circle bg-soft-info text-info fs-18">
                                        <i class="ri-group-line"></i>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-muted mb-1 fs-12">
                                        Target Peserta
                                    </p>

                                    <h6 class="mb-0 fw-semibold">
                                        {{ $kegiatan->targetPeserta() }}
                                        <small class="text-muted">Generus</small>
                                    </h6>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

            {{-- INSIGHT --}}
            <div class="card-body bg-light-subtle">

                <div class="d-flex align-items-start">

                    <div class="flex-shrink-0 me-3">

                        <div class="avatar-sm">
                            <div class="avatar-title rounded-circle bg-soft-primary text-primary fs-20">
                                <i class="ri-bar-chart-grouped-line"></i>
                            </div>
                        </div>

                    </div>

                    <div class="flex-grow-1">

                        <h6 class="fw-semibold mb-1">
                            Insight Kehadiran Kelompok
                        </h6>

                        <p class="text-muted mb-0">
                            Monitoring kehadiran rutin generus kelompok
                            {{ $nama_kelompok }} Desa {{ $nama_desa }}
                            digunakan untuk mengevaluasi konsistensi
                            keaktifan peserta pada kegiatan mingguan.
                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- MATRIX --}}
        <div class="row g-3">

            <div class="col-12">

                @livewire(
                    'laporan.kelompok.kegiatan-rutin.report.attendance-matrix',
                    [
                        'kegiatanId' => $kegiatanId,
                        'kelompokId' => $ms_kelompok_id,
                    ],
                    key("attendance-matrix-{$kegiatanId}-{$ms_kelompok_id}")
                )

            </div>

        </div>

        @endif

    </div>

</div>