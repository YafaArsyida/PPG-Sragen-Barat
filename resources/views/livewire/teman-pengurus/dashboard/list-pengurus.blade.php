<div class="card border-0 shadow-sm h-100 overflow-hidden">
    {{-- HEADER --}}
    <div class="card-header bg-white border-0 py-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-18">
                            <i class="ri-team-line">
                            </i>
                        </div>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold">
                            Data Pengurus
                        </h5>
                        {{-- <small class="">
                            Pengurus dengan jenjang usianya
                        </small> --}}
                    </div>
                </div>
            </div>
            {{-- TOTAL --}}
            <div class="text-lg-end">
                <div class="badge bg-primary-subtle text-primary fs-13 px-3 py-2 rounded-pill">
                    <i class="ri-database-2-line me-1">
                    </i>
                    {{ $data->total() }} Pengurus
                </div>
            </div>
        </div>
    </div>
    {{-- FILTER --}}
    <div class="card-body border-top bg-light-subtle pb-0">
        <div class="row g-3 align-items-end">
            {{-- SEARCH --}}
            <div class="col-xxl-12 col-lg-12">
                <label class="form-label fw-semibold">
                    Cari Nama Pengurus
                </label>
                <div class="search-box">
                    <input type="text" class="form-control border-light shadow-sm rounded-3"
                        wire:model.debounce.400ms="search" placeholder="Ketik nama pengurus...">
                    <i class="ri-search-line search-icon">
                    </i>
                </div>
            </div>
        </div>
    </div>
    {{-- TABLE --}}
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle table-nowrap mb-0">
                <thead class="table-light">
                    <tr class="text-uppercase fw-semibold">
                        <th width="60px" class="">No</th>
                        <th class="">Pengurus</th>
                        <th class="text-center ">Usia</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $index => $item)
                    <tr>
                        {{-- NO --}}
                        <td class="fw-semibold text-muted">
                            {{ $data->firstItem() + $index }}
                        </td>
                        {{-- NAMA --}}
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-xs flex-shrink-0">
                                    <div class="avatar-title 
                                        {{ $item->jenis_kelamin == 'perempuan'
                                            ? 'bg-danger-subtle text-danger'
                                            : 'bg-primary-subtle text-primary' 
                                        }} 
                                        rounded-circle fw-semibold">
                                        {{ strtoupper(substr($item->nama_pengurus, 0, 1)) }}
                                    </div>
                                </div>
                                <div>
                                    <div class="fw-semibold">
                                        {{ $item->nama_pengurus }}
                                    </div>
                                    <small class="text-muted">
                                        {{ $item->ms_kelompok->nama_kelompok }}
                                    </small>
                                </div>
                            </div>
                        </td>
                        {{-- USIA --}}
                        <td class="text-center">
                            @if($item->usia)
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                <i class="ri-calendar-line me-1">
                                </i>
                                {{ $item->usia }} Tahun
                            </span>
                            @else
                            <span class="text-muted">
                                -
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-md mb-3">
                                    <div class="avatar-title bg-light text-muted rounded-circle fs-2">
                                        <i class="ri-inbox-archive-line">
                                        </i>
                                    </div>
                                </div>
                                <h6 class="fw-semibold mb-1">
                                    Tidak Ada Data Pengurus
                                </h6>
                                <p class="text-muted mb-0 fs-13">
                                    Data Pengurus belum tersedia atau tidak ditemukan.
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- PAGINATION --}}
        <div class="mt-4 d-flex justify-content-end">
            {{ $data->links() }}
        </div>
    </div>
</div>