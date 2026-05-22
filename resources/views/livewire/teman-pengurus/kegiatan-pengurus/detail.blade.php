<div wire:ignore.self class="modal fade" id="KegiatanDetail" tabindex="-1"
    aria-labelledby="KegiatanDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="modal-header border-0 pb-0 p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-calendar-event-line">
                            </i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-semibold mb-0" id="KegiatanDetailLabel">
                            Detail Kegiatan Pengurus
                        </h5>
                        <small>
                            Informasi lengkap kegiatan, lokasi, dan akses presensi peserta.
                        </small>
                    </div>
                </div>
                <button type="button" class="btn btn-light btn-icon rounded-circle shadow-none" data-bs-dismiss="modal">
                    <i class="ri-close-line fs-18">
                    </i>
                </button>
            </div>
            @if($kegiatan) {{-- BODY --}}
            <div class="modal-body p-4">
                {{-- HERO --}}
                <div class="border rounded-4 p-4 bg-light-subtle mb-4">
                    <div class="d-flex flex-column flex-lg-row justify-content-between gap-4">
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-3 flex-wrap">
                                <span class="badge rounded-pill px-3 py-2 bg-primary-subtle text-primary">
                                    <i class="ri-calendar-event-line me-1">
                                    </i>
                                </span>
                                <span class="badge bg-dark-subtle text-dark rounded-pill px-3 py-2">
                                    Kegiatan Pengurus
                                </span>
                            </div>
                            <h3 class="fw-bold mb-2">
                                {{ $kegiatan->nama_kegiatan }}
                            </h3>
                            @if($kegiatan->deskripsi)
                            <p class="text-muted mb-0 lh-lg">
                                {{ $kegiatan->deskripsi }}
                            </p>
                            @endif
                        </div>
                        {{-- QUICK INFO --}}
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-center gap-2 text-muted">
                                <i class="ri-time-line text-warning">
                                </i>
                                <span>
                                    Update:
                                    <strong class="text-body">
                                        {{ $kegiatan->updated_at?->format('d M Y') ?? '-' }}
                                    </strong>
                                </span>
                            </div>
                            <div class="d-flex align-items-center gap-2 text-muted">
                                <i class="ri-group-line text-success">
                                </i>
                                <span>
                                    Peserta: Pengurus
                                </span>
                            </div>
                            {{-- <div class="d-flex align-items-center gap-2 text-muted">
                                <i class="ri-user-star-line text-primary">
                                </i>
                                <span>
                                    Target:
                                    <strong class="text-body">
                                        {{ $kegiatan->targetPeserta() ?? '-' }} Peserta
                                    </strong>
                                </span>
                            </div> --}}
                        </div>
                    </div>
                </div>
                {{-- DETAIL --}}
                <div class="row g-4">
                    {{-- JADWAL --}}
                    <div class="col-lg-4">
                        <div class="border rounded-4 p-4 h-100">
                            <div class="d-flex align-items-center gap-2 mb-4">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-success-subtle text-success rounded-circle fs-20">
                                        <i class="ri-calendar-check-line">
                                        </i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="fw-semibold mb-0">
                                        Jadwal Kegiatan
                                    </h5>
                                    <small>
                                        Informasi waktu pelaksanaan kegiatan.
                                    </small>
                                </div>
                            </div>
                            <div class="vstack gap-3">
                                {{-- Hari --}}
                                <div class="border border-2 border-dashed rounded-4 p-3 bg-light-subtle">
                                    <p class="text-muted mb-1 fs-13">
                                        Tanggal / Hari
                                    </p>
                                    <h6 class="mb-0 fw-semibold">
                                        {{ $kegiatan->tanggal ? \App\Http\Controllers\HelperController::formatTanggalIndonesia($kegiatan->tanggal,'d F Y') : '-' }}
                                    </h6>
                                </div>
                                {{-- Waktu --}}
                                <div class="border border-2 border-dashed rounded-4 p-3 bg-light-subtle">
                                    <p class="text-muted mb-1 fs-13">
                                        Waktu Pelaksanaan
                                    </p>
                                    <h6 class="mb-0 fw-semibold">
                                        {{ $kegiatan->waktu ?? '-' }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- LOKASI --}}
                    <div class="col-lg-8">
                        <div class="border rounded-4 p-4 h-100 bg-light-subtle">
                            <div class="d-flex align-items-center gap-2 mb-4">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-warning-subtle text-warning rounded-circle fs-20">
                                        <i class="ri-map-pin-2-line">
                                        </i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="fw-semibold mb-0">
                                        Lokasi Kegiatan
                                    </h5>
                                    <small>
                                        Detail lingkup dan lokasi kegiatan.
                                    </small>
                                </div>
                            </div>
                            <div class="vstack gap-3">
                                {{-- Tempat --}}
                                <div class="border border-2 border-dashed rounded-4 p-3 bg-white">
                                    <p class="text-muted mb-1 fs-13">
                                        Tempat
                                    </p>
                                    <h6 class="mb-0 fw-semibold">
                                        {{ $kegiatan->tempat }}
                                    </h6>
                                </div>
                                {{-- Alamat --}}
                                <div class="border border-2 border-dashed rounded-4 p-3 bg-white">
                                    <p class="text-muted mb-1 fs-13">
                                        Alamat
                                    </p>
                                    <h6 class="mb-0 fw-semibold lh-base">
                                        {{ $kegiatan->alamat }}
                                    </h6>
                                </div>
                                {{-- Maps --}} 
                                @if($kegiatan->peta)
                                <a href="{{ $kegiatan->peta }}" target="_blank"
                                    class="btn btn-primary rounded-pill align-self-start px-4">
                                    <i class="ri-map-pin-line me-1">
                                    </i>
                                    Buka Google Maps
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- AKSES --}}
                    <div class="col-12">
                        <div class="border rounded-4 p-4">
                            <div class="d-flex align-items-center gap-2 mb-4">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-info-subtle text-info rounded-circle fs-20">
                                        <i class="ri-links-line">
                                        </i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="fw-semibold mb-0">
                                        Akses & Dokumen
                                    </h5>
                                    <small>
                                        Pengumuman, laporan, dan akses presensi kegiatan.
                                    </small>
                                </div>
                            </div>
                            <div class="row g-3">
                                {{-- Pengumuman --}}
                                <div class="col-lg-3 col-sm-6">
                                    <div class="border rounded-4 p-3 h-100 bg-light-subtle">
                                        <div class="d-flex align-items-start gap-3">
                                            <div class="avatar-sm">
                                                <div class="avatar-title bg-success-subtle text-success rounded-circle">
                                                    <i class="mdi mdi-whatsapp fs-18">
                                                    </i>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-muted fs-13 mb-1">
                                                    Pengumuman
                                                </p>
                                                <a style="cursor: pointer"
                                                    wire:click.prevent="kegiatanPengumuman({{ $kegiatan->ms_kegiatan_id }})"
                                                    class="fw-semibold text-success">
                                                    Cetak Pengumuman
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Laporan --}}
                                <div class="col-lg-3 col-sm-6">
                                    <div class="border rounded-4 p-3 h-100 bg-light-subtle">
                                        <div class="d-flex align-items-start gap-3">
                                            <div class="avatar-sm">
                                                <div class="avatar-title bg-danger-subtle text-danger rounded-circle">
                                                    <i class="mdi mdi-file-chart-outline fs-18">
                                                    </i>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-muted fs-13 mb-1">
                                                    Laporan
                                                </p>
                                                <a wire:click.prevent="$emit('KegiatanPengumuman', {{ $kegiatan->ms_kegiatan_id }})"
                                                    class="fw-semibold text-danger">
                                                    Cetak Laporan
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Presensi Kartu --}}
                                <div class="col-lg-3 col-sm-6">
                                    <div class="border rounded-4 p-3 h-100 bg-light-subtle">
                                        <div class="d-flex align-items-start gap-3">
                                            <div class="avatar-sm">
                                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                    <i class="mdi mdi-qrcode fs-18">
                                                    </i>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-muted fs-13 mb-1">
                                                    Presensi Kartu
                                                </p>
                                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                                    <a href="{{ route('operasional.presensi-kegiatan-kartu', $kegiatan->token) }}"
                                                        target="_blank" class="fw-semibold text-primary">
                                                        Buka Presensi
                                                    </a>
                                                    <button type="button"
                                                        class="btn btn-sm btn-light btn-icon rounded-circle"
                                                        onclick="copyToClipboard('{{ route('operasional.presensi-kegiatan-kartu', $kegiatan->token) }}')">
                                                        <i class="mdi mdi-content-copy">
                                                        </i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Presensi Manual --}}
                                <div class="col-lg-3 col-sm-6">
                                    <div class="border rounded-4 p-3 h-100 bg-light-subtle">
                                        <div class="d-flex align-items-start gap-3">
                                            <div class="avatar-sm">
                                                <div
                                                    class="avatar-title bg-secondary-subtle text-secondary rounded-circle">
                                                    <i class="mdi mdi-account-edit-outline fs-18">
                                                    </i>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-muted fs-13 mb-1">
                                                    Presensi Manual
                                                </p>
                                                @if($kegiatan->status == 'selesai')
                                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                                    <span class="fw-semibold text-muted">
                                                        Presensi Ditutup
                                                    </span>
                                                    <button type="button"
                                                        class="btn btn-sm btn-light btn-icon rounded-circle" disabled
                                                        title="Kegiatan telah selesai">
                                                        <i class="ri-lock-line">
                                                        </i>
                                                    </button>
                                                </div>
                                                @else
                                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                                    <a href="{{ route('temanpengurus.presensi-kegiatan', $kegiatan->token) }}"
                                                        target="_blank" class="fw-semibold text-secondary">
                                                        Buka Presensi
                                                    </a>
                                                    <button type="button"
                                                        class="btn btn-sm btn-light btn-icon rounded-circle"
                                                        onclick="copyToClipboard('{{ route('temanpengurus.presensi-kegiatan', $kegiatan->token) }}')">
                                                        <i class="mdi mdi-content-copy">
                                                        </i>
                                                    </button>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif {{-- FOOTER --}}
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