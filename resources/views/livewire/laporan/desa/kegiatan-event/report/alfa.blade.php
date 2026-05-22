<div class="card border-0 rounded-4 overflow-hidden">
    {{-- HEADER --}}
    <div class="card-header border-0 p-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            {{-- TITLE --}}
            <div class="d-flex align-items-center gap-3">
                <div class="avatar-sm">
                    <div class="avatar-title bg-danger-subtle text-danger rounded-circle fs-18">
                        <i class="ri-team-line">
                        </i>
                    </div>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">
                        Generus Alfa/Tidak Hadir
                    </h5>
                    <small>
                        Monitoring generus yang belum hadir pada kegiatan.
                    </small>
                </div>
            </div>
            {{-- ACTION --}}
            <div class="d-flex gap-2 flex-wrap">
                <button id="btnExportAttendance" class="btn btn-success rounded-pill px-4 shadow-sm">
                    <i class="ri-file-excel-2-line me-1">
                    </i>
                    Export Excel
                </button>
            </div>
        </div>
    </div>
    {{-- FILTER --}}
    <div class="card-body border-top bg-light-subtle">
        <div class="row g-3 align-items-end">
            {{-- SEARCH --}}
            <div class="col-xxl-6 col-lg-6">
                <label class="form-label fw-semibold">
                    Cari Nama Generus
                </label>
                <div class="search-box">
                    <input type="text" class="form-control border-light rounded-3"
                        wire:model.debounce.400ms="search" placeholder="Ketik nama generus...">
                    <i class="ri-search-line search-icon">
                    </i>
                </div>
            </div>
            {{-- KELOMPOK --}}
            <div class="col-xxl-3 col-lg-3 col-sm-6">
                <label class="form-label fw-semibold">
                    Kelompok
                </label>
                <select class="form-select rounded-3 border-light" wire:model="ms_kelompok_id" {{ !$ms_desa_id
                    ? 'disabled' : '' }}>
                    <option value="">
                        Semua Kelompok
                    </option>
                    @foreach($listKelompok as $k)
                    <option value="{{ $k->ms_kelompok_id }}">
                        Kelompok {{ $k->nama_kelompok }}
                    </option>
                    @endforeach
                </select>
            </div>
            {{-- GENDER --}}
            <div class="col-xxl-3 col-lg-3 col-sm-6">
                <label class="form-label fw-semibold">
                    Gender
                </label>
                <select class="form-select rounded-3 border-light" wire:model="gender">
                    <option value="">
                        Semua Generus
                    </option>
                    <option value="laki-laki">
                        Laki-laki
                    </option>
                    <option value="perempuan">
                        Perempuan
                    </option>
                </select>
            </div>
        </div>
    </div>
    {{-- TABLE --}}
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table id="Alfa" class="table align-middle table-hover mb-0">
                <thead class="bg-light">
                    <tr class="text-uppercase fw-semibold">
                        <th style="width: 60px">#</th>
                        <th>Generus</th>
                        <th>Kelompok</th>
                        <th class="text-center">status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alfa as $i => $g)
                    <tr>
                        {{-- NO --}}
                        <td class="text-muted fw-semibold">
                            {{ ($alfa->currentPage() - 1) * $alfa->perPage() + $loop->iteration }}
                        </td>
                        {{-- NAMA --}}
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-xs flex-shrink-0">
                                    <div class="avatar-title 
                                        {{ $g->jenis_kelamin == 'perempuan'
                                        ? 'bg-danger-subtle text-danger'
                                        : 'bg-primary-subtle text-primary' 
                                        }} 
                                        rounded-circle fw-semibold"
                                    >
                                        {{ strtoupper(substr($g->nama_generus, 0, 1)) }}
                                    </div>
                                </div>
                                <div>
                                    <div class="fw-semibold">
                                        {{ $g->nama_generus }}
                                    </div>
                                    <small class="text-muted">
                                        {{ strtoupper($g->jenis_kelamin) }}
                                    </small>
                                </div>
                            </div>
                        </td>
                        {{-- KELOMPOK --}}
                        <td>
                            <div class="fw-semibold">
                                Kelompok {{ $g->ms_kelompok->nama_kelompok ?? '-' }}
                            </div>
                        </td>
                        {{-- STATUS --}}
                        <td class="text-danger fw-semibold text-center">
                            Alfa
                        </td>
                    </tr>
                    @empty {{-- EMPTY --}}
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-md mb-3">
                                    <div class="avatar-title bg-light text-muted rounded-circle fs-24">
                                        <i class="ri-inbox-archive-line">
                                        </i>
                                    </div>
                                </div>
                                <h6 class="fw-semibold mb-1">
                                    Belum Ada Data Alfa
                                </h6>
                                <p class="text-muted mb-0 fs-13">
                                    Semua generus hadir atau belum ada data presensi.
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- PAGINATION --}}
    <div class="card-footer bg-white border-top py-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="text-muted fs-13">
                Menampilkan
                <span class="fw-semibold">
                    {{ $alfa->firstItem() ?? 0 }}
                </span>
                -
                <span class="fw-semibold">
                    {{ $alfa->lastItem() ?? 0 }}
                </span>
                dari
                <span class="fw-semibold">
                    {{ $alfa->total() }}
                </span>
                data alfa
            </div>
            <div>
                {{ $alfa->links() }}
            </div>
        </div>
    </div>
</div>