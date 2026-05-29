<div class="row g-4">
    @forelse($listKelompok as $item)
    <div class="col-xxl-4 col-lg-6">
        <div class="card border-1 shadow-sm rounded-4 h-100 kelompok-card">
            {{-- HEADER --}}
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    {{-- Identity --}}
                    <div class="flex-grow-1 pe-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="avatar-sm">
                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-18">
                                    <i class="ri-community-line">
                                    </i>
                                </div>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">
                                    Kelompok {{ $item->nama_kelompok }}
                                </h5>
                                <small>
                                    {{ $item->nama_masjid ?? 'Masjid belum diatur' }}
                                </small>
                            </div>
                        </div>
                    </div>
                    {{-- Actions --}}
                    <div class="dropdown">
                        <button class="btn btn-icon rounded-circle btn-sm" data-bs-toggle="dropdown">
                            <i class="ri-more-2-fill">
                            </i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                            <li>
                                <a class="dropdown-item" href="#ModalDetailKelompok" data-bs-toggle="modal"
                                    wire:click.prevent="$emit('KelompokDetail', {{ $item->ms_kelompok_id }})">
                                    <i class="ri-eye-line me-2 text-primary">
                                    </i>
                                    Detail
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#ModalEditKelompok" data-bs-toggle="modal"
                                    wire:click.prevent="$emit('KelompokEdit', {{ $item->ms_kelompok_id }})">
                                    <i class="ri-pencil-line me-2 text-warning">
                                    </i>
                                    Edit
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="#ModalDeleteKelompok" data-bs-toggle="modal"
                                    wire:click.prevent="$emit('KelompokDelete', {{ $item->ms_kelompok_id }})">
                                    <i class="ri-delete-bin-5-line me-2">
                                    </i>
                                    Hapus
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- ADDRESS --}}
                <div class="bg-light rounded-3 p-3 mt-3">
                    <div class="d-flex align-items-start gap-2">
                        <i class="ri-map-pin-line text-danger fs-18 mt-1">
                        </i>
                        <div class="flex-grow-1">
                            <div class="fs-11 text-muted mb-1">
                                Alamat
                            </div>
                            <div class="fw-medium text-body small">
                                {{ $item->alamat ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- META --}}
                <div class="d-flex flex-wrap gap-3 mt-3 text-muted">
                    <div class="d-flex align-items-center gap-1">
                        <i class="ri-government-line text-primary">
                        </i> Desa {{ $item->ms_desa->nama_desa ?? '-' }}
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <i class="ri-time-line text-success">
                        </i>
                        Update {{ $item->updated_at?->format('d M Y') ?? '-' }}
                    </div>
                </div>
            </div>
            {{-- STATS --}}
            <div class="card-body">
                <div class="row g-3">
                    {{-- Generus --}}
                    <div class="col-4">
                        <div class="bg-light rounded-4 p-3 text-center h-100">
                            <div class="fs-22 text-primary mb-2">
                                <i class="ri-group-line">
                                </i>
                            </div>
                            <div class="fw-bold fs-18">
                                {{ $item->jumlah_generus() ?? 0 }}
                            </div>
                            <div class="text-muted fs-11">
                                Generus
                            </div>
                        </div>
                    </div>
                    {{-- Desa --}}
                    <div class="col-4">
                        <div class="bg-light rounded-4 p-3 text-center h-100">
                            <div class="fs-22 text-success mb-2">
                                <i class="ri-building-2-line">
                                </i>
                            </div>
                            <div class="fw-semibold fs-13 text-truncate">
                                {{ $item->ms_desa->nama_desa ?? '-' }}
                            </div>
                            <div class="text-muted fs-11">
                                Desa
                            </div>
                        </div>
                    </div>
                    {{-- Peta --}}
                    <div class="col-4">
                        <div class="bg-light rounded-4 p-3 text-center h-100">
                            <div class="fs-22 text-danger mb-2">
                                <i class="ri-map-2-line">
                                </i>
                            </div>
                            @if($item->peta)
                            <a href="{{ $item->peta }}" target="_blank"
                                class="fw-semibold text-primary text-decoration-none fs-13">
                                Lihat
                            </a>
                            @else
                            <div class="fw-semibold fs-13">
                                -
                            </div>
                            @endif
                            <div class="text-muted fs-11">
                                Lokasi
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5">
                <div class="mb-3">
                    <i class="ri-inbox-2-line text-muted" style="font-size: 48px;"></i>
                </div>
                <h5 class="fw-semibold mb-1">
                    Data kelompok kosong
                </h5>
                <p class="text-muted mb-0">
                    Belum ada kelompok yang tersedia saat ini
                </p>
            </div>
        </div>
    </div>
    
    @endforelse
</div>