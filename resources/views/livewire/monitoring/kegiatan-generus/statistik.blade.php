<div class="row g-3">

    {{-- TOTAL KELOMPOK --}}
    <div class="col-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-3 p-lg-4">

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-info-subtle text-info rounded-circle fs-20">
                            <i class="ri-home-line"></i>
                        </div>
                    </div>

                    <span class="badge bg-info-subtle text-info rounded-pill">
                        Kelompok
                    </span>
                </div>

                <h3 class="fw-bold mb-1">
                    {{ number_format($this->totalKelompok) }}
                </h3>

                <p class="text-muted mb-0 fs-13">
                    Kelompok Aktif
                </p>

            </div>
        </div>
    </div>


    {{-- TOTAL GENERUS --}}
    <div class="col-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-3 p-lg-4">

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-group-line"></i>
                        </div>
                    </div>

                    <select
                        wire:model="selectedKelompok"
                        class="form-select form-select-sm border-0 bg-info-subtle text-info rounded-pill fw-semibold"
                        style="width: auto; min-width: 105px;">

                        <option value="">
                            Semua
                        </option>

                        @foreach($this->kelompokList as $kelompok)
                            <option value="{{ $kelompok->ms_kelompok_id }}">
                                {{ $kelompok->nama_kelompok }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <h3 class="fw-bold mb-1">
                    {{ number_format($this->totalGenerus) }}
                </h3>

                <p class="text-muted mb-0 fs-13">
                    Total Generus
                </p>

            </div>
        </div>
    </div>
    
    {{-- TOTAL KEGIATAN --}}
    <div class="col-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-3 p-lg-4">

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-warning-subtle text-warning rounded-circle fs-20">
                            <i class="ri-calendar-event-line"></i>
                        </div>
                    </div>

                    <select
                        wire:model="periodeKegiatan"
                        class="form-select form-select-sm border-0 bg-warning-subtle text-warning rounded-pill fw-semibold"
                        style="width: auto; min-width: 105px;">

                        <option value="1_bulan">
                            1 Bulan
                        </option>

                        <option value="3_bulan">
                            3 Bulan
                        </option>

                        <option value="1_tahun">
                            1 Tahun
                        </option>

                    </select>
                </div>

                <h3 class="fw-bold mb-1">
                    {{ number_format($this->totalKegiatan) }}
                </h3>

                <p class="text-muted mb-0 fs-13">
                    Total Kegiatan
                </p>

            </div>
        </div>
    </div>


    {{-- RATA-RATA KEHADIRAN --}}
    <div class="col-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-3 p-lg-4">

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-success-subtle text-success rounded-circle fs-20">
                            <i class="ri-calendar-check-line"></i>
                        </div>
                    </div>

                    <select
                        wire:model="periodeKehadiran"
                        class="form-select form-select-sm border-0 bg-success-subtle text-success rounded-pill fw-semibold"
                        style="width: auto; min-width: 105px;">
                        <option value="1_bulan">1 Bulan</option>
                        <option value="3_bulan">3 Bulan</option>
                        <option value="1_tahun">1 Tahun</option>
                    </select>
                </div>

                <h3 class="fw-bold mb-1">
                    {{ $this->rataKehadiran }}%
                </h3>

                <p class="text-muted mb-0 fs-13">
                    Rata-rata Kehadiran
                </p>

            </div>
        </div>
    </div>

</div>