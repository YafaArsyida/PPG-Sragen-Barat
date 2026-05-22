<div wire:ignore.self class="modal fade" id="PengurusDetail" tabindex="-1" aria-labelledby="PengurusDetailLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="modal-header border-0 pb-0 p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-info-subtle text-info rounded-circle fs-20">
                            <i class="ri-user-search-line">
                            </i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1" id="PengurusDetailLabel">
                            Detail Pengurus
                        </h5>
                        <small>
                            Informasi lengkap pengurus dan dapukan
                        </small>
                    </div>
                </div>
                <button type="button" class="btn btn-light btn-icon rounded-circle" data-bs-dismiss="modal">
                    <i class="ri-close-line fs-18">
                    </i>
                </button>
            </div>
            <div class="modal-body p-4">
                @if($pengurus) {{-- PROFILE --}}
                <div class="card border-0 bg-light-subtle rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex flex-column flex-lg-row align-items-lg-start justify-content-between gap-4">
                            {{-- LEFT --}}
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="avatar-md">
                                        <div class="avatar-title rounded-circle bg-primary text-white fs-24 fw-bold">
                                            {{ strtoupper(substr($pengurus->nama_pengurus, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold mb-1">
                                            {{ $pengurus->nama_pengurus }}
                                        </h3>
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                                                <i class="ri-team-line me-1">
                                                </i>
                                                {{ $pengurus->ms_kelompok->nama_kelompok ?? '-' }}
                                            </span>
                                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                                                <i class="ri-government-line me-1">
                                                </i>
                                                {{ $pengurus->ms_kelompok->ms_desa->nama_desa ?? '-' }}
                                            </span>
                                            @if($pengurus->kode_pengurus)
                                            <span class="badge bg-dark-subtle text-dark rounded-pill px-3 py-2">
                                                <i class="ri-shield-user-line me-1">
                                                </i>
                                                {{ $pengurus->kode_pengurus }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- DESKRIPSI --}}
                                <div class="bg-white rounded-3 p-3 border">
                                    <p class="text-muted small fw-semibold mb-2">
                                        Deskripsi
                                    </p>
                                    <p class="mb-0 text-body">
                                        {{ $pengurus->deskripsi ?? 'Tidak ada deskripsi tambahan.' }}
                                    </p>
                                </div>
                            </div>
                            {{-- RIGHT --}}
                            <div class="text-lg-end">
                                <div class="bg-white border rounded-3 px-4 py-3">
                                    <p class="text-muted small mb-1">
                                        Terakhir Diperbarui
                                    </p>
                                    <h6 class="fw-semibold mb-0">
                                        <i class="ri-time-line text-warning me-1">
                                        </i>
                                        {{ $pengurus->updated_at?->format('d M Y') ?? '-' }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- INFORMASI DETAIL --}}
                <div class="row g-4 mb-4">
                    {{-- JENIS KELAMIN --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="card border h-100 rounded-4 shadow-sm mb-0">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-sm">
                                        <div class="avatar-title rounded-circle bg-info-subtle text-info fs-20">
                                            <i class="ri-user-line">
                                            </i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-1 small">
                                            Jenis Kelamin
                                        </p>
                                        <h6 class="fw-bold mb-0 text-capitalize">
                                            {{ $pengurus->jenis_kelamin ?? '-' }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- TEMPAT LAHIR --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="card border h-100 rounded-4 shadow-sm mb-0">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-sm">
                                        <div class="avatar-title rounded-circle bg-success-subtle text-success fs-20">
                                            <i class="ri-map-pin-line">
                                            </i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-1 small">
                                            Tempat Lahir
                                        </p>
                                        <h6 class="fw-bold mb-0">
                                            {{ $pengurus->tempat_lahir ?? '-' }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- TANGGAL LAHIR --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="card border h-100 rounded-4 shadow-sm mb-0">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-sm">
                                        <div class="avatar-title rounded-circle bg-warning-subtle text-warning fs-20">
                                            <i class="ri-calendar-line">
                                            </i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-1 small">
                                            Tanggal Lahir
                                        </p>
                                        <h6 class="fw-bold mb-0">
                                            @if($pengurus->tanggal_lahir) {{
                                            \Carbon\Carbon::parse($pengurus->tanggal_lahir)->format('d
                                            M Y') }}
                                            <span class="text-muted fw-normal">
                                                ({{ \Carbon\Carbon::parse($pengurus->tanggal_lahir)->age }} Tahun)
                                            </span>
                                            @else - @endif
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- TELEPON --}}
                    <div class="col-lg-6">
                        <div class="card border rounded-4 shadow-sm mb-0 h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-sm">
                                        <div class="avatar-title rounded-circle bg-primary-subtle text-primary fs-20">
                                            <i class="ri-smartphone-line">
                                            </i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-1 small">
                                            Nomor Telepon
                                        </p>
                                        <h6 class="fw-bold mb-0">
                                            {{ $pengurus->telepon ?? '-' }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ALAMAT --}}
                    <div class="col-lg-6">
                        <div class="card border rounded-4 shadow-sm mb-0 h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="avatar-sm flex-shrink-0">
                                        <div class="avatar-title rounded-circle bg-danger-subtle text-danger fs-20">
                                            <i class="ri-home-4-line">
                                            </i>
                                        </div>
                                    </div>
                                    <div class="w-100">
                                        <p class="text-muted mb-1 small">
                                            Alamat
                                        </p>
                                        <h6 class="fw-semibold mb-0 lh-base">
                                            {{ $pengurus->alamat ?? '-' }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- DAPUKAN --}}
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                <i class="ri-briefcase-4-line me-1">
                                </i>
                                Dapukan Pengurus
                            </span>
                            <span class="badge bg-light text-dark rounded-pill">
                                {{ count($listPenempatan) }}
                            </span>
                        </div>
                    </div>
                    <div class="row g-3">
                        @forelse($listPenempatan as $item)
                        <div class="col-lg-6">
                            <div class="card border rounded-4 shadow-sm mb-0 h-100">
                                <div class="card-body">
                                    {{-- BADGE --}}
                                    <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                                        <span class="badge bg-primary-subtle text-primary">
                                            {{ $item->ms_dapukan->nama_dapukan ?? '-' }}
                                        </span>
                                        @if($item->status == 'aktif')
                                        <span class="badge bg-success-subtle text-success">
                                            Aktif
                                        </span>
                                        @else
                                        <span class="badge bg-danger-subtle text-danger">
                                            Nonaktif
                                        </span>
                                        @endif
                                    </div>
                                    {{-- TITLE --}}
                                    <h6 class="fw-bold mb-2">
                                        {{ $item->nama_penempatan }}
                                    </h6>
                                    {{-- DESC --}} @if($item->deskripsi)
                                    <div class="text-muted fs-13 lh-base">
                                        {{ $item->deskripsi }}
                                    </div>
                                    @else
                                    <div class="text-muted fs-13">
                                        Tidak ada deskripsi tambahan
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="card border-0 bg-light-subtle rounded-4 mb-0">
                                <div class="card-body text-center py-5">
                                    <div class="avatar-md mx-auto mb-3">
                                        <div class="avatar-title rounded-circle bg-light text-muted fs-30">
                                            <i class="ri-inbox-2-line">
                                            </i>
                                        </div>
                                    </div>
                                    <h6 class="fw-bold mb-1">
                                        Belum Ada Dapukan
                                    </h6>
                                    <p class="text-muted mb-0">
                                        Pengurus ini belum memiliki penempatan dapukan
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
                @endif
            </div>
            {{-- FOOTER --}}
            <div class="modal-footer border-0 px-4 pb-4 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="ri-close-line me-1">
                    </i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>