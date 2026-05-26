<div class="card border-0 shadow-sm overflow-hidden">
    {{-- TOP ALERT --}}
    <div class="alert alert-primary rounded-0 border-0 m-0 d-flex align-items-center px-4 py-3">
        <div class="flex-shrink-0">
            <div class="avatar-sm">
                <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                    <i class="ri-team-line">
                    </i>
                </div>
            </div>
        </div>
        <div class="flex-grow-1 ms-3">
            <h6 class="mb-1 fw-semibold">
                Kelola Data Pengurus Lebih Modern
            </h6>
            <p class="mb-0 text-muted fs-13">
                Manajemen kepengurusan kini lebih terstruktur, cepat, dan terintegrasi.
            </p>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('temanpengurus.administrasi.pengurus') }}" class="btn btn-primary rounded-pill px-3">
                <i class="ri-arrow-right-line align-middle me-1">
                </i>
                Buka Data
            </a>
        </div>
    </div>
    {{-- MAIN CONTENT --}}
    <div class="card-body p-0">
        <div class="row align-items-center g-0">
            {{-- LEFT --}}
            <div class="col-lg-12">
                <div class="p-4 p-lg-4">
                    {{-- BADGE --}}
                    <div class="mb-3">
                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                            Sistem Administrasi Pengurus
                        </span>
                    </div>
                    {{-- TITLE --}}
                    <h2 class="fw-bold mb-3 lh-base">
                        Kelola Data Pengurus dalam
                        <span class="text-primary">
                            Satu Sistem Terpusat
                        </span>
                    </h2>
                    {{-- DESC --}}
                    <p class="text-muted fs-15 mb-4">
                        Akses data identitas, kelompok, status keaktifan, hingga monitoring kegiatan
                        Pengurus dengan tampilan modern dan proses administrasi yang lebih efisien.
                    </p>
                    {{-- FEATURES --}}
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-2">
                                <div class="flex-shrink-0 text-success fs-18">
                                    <i class="ri-checkbox-circle-fill">
                                    </i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">
                                        Data Terpusat
                                    </h6>
                                    <p class="mb-0 text-muted fs-13">
                                        Semua data pengurus tersimpan rapi dalam satu sistem.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-2">
                                <div class="flex-shrink-0 text-primary fs-18">
                                    <i class="ri-shield-check-fill">
                                    </i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">
                                        Akses Aman
                                    </h6>
                                    <p class="mb-0 text-muted fs-13">
                                        Pengelolaan data sesuai hak akses petugas.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-2">
                                <div class="flex-shrink-0 text-warning fs-18">
                                    <i class="ri-bar-chart-box-fill">
                                    </i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">
                                        Monitoring Aktif
                                    </h6>
                                    <p class="mb-0 text-muted fs-13">
                                        Pantau perkembangan dan kehadiran pengurus.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-2">
                                <div class="flex-shrink-0 text-danger fs-18">
                                    <i class="ri-flashlight-fill">
                                    </i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">
                                        Administrasi Cepat
                                    </h6>
                                    <p class="mb-0 text-muted fs-13">
                                        Mempermudah pencarian dan pengelolaan data.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- BUTTON --}}
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('temanpengurus.administrasi.pengurus') }}"
                            class="btn btn-primary rounded-pill px-4">
                            <i class="ri-team-line align-middle me-1">
                            </i>
                            Kelola Data Pengurus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>