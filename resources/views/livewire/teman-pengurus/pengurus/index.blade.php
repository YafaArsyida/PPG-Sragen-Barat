<div class="card border-0 shadow-sm rounded-4 overflow-hidden" id="kegiatanGenerusList">
    {{-- HEADER --}}
    <div class="card-header bg-white border-0 p-4">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4">
            {{-- TITLE --}}
            <div>
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-team-line"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">
                            Master Pengurus
                        </h5>
                        <small>
                            Kelola data pengurus sesuai dapukannya
                        </small>
                    </div>
                </div>
            </div>

            {{-- ACTION --}}
            <div class="d-flex gap-2 flex-wrap">
                {{-- IMPORT --}}
                <button type="button" class="btn btn-light border rounded-pill px-4" data-bs-toggle="modal"
                    data-bs-target="#ExportLaporanExcel">
                    <i class="ri-database-2-line me-1 text-secondary"></i>
                    Export Data
                </button>
                {{-- Master dapukan --}}
                <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDapukan" aria-controls="offcanvasDapukan">
                    <i class="ri-building-line me-1">
                    </i>
                    Master Dapukan
                </button>
                {{-- TAMBAH --}}
                <button type="button" class="btn btn-success rounded-pill px-4" data-bs-toggle="modal"
                    data-bs-target="#PengurusCreate"
                    wire:click.prevent="$emit('PengurusCreate')">
                    <i class="ri-add-line me-1"></i>Tambah Pengurus
                </button>
            </div>
        </div>
    </div>
    {{-- FILTER --}}
    <div class="card-body border-top border-bottom bg-light-subtle">
        <div class="row g-3 align-items-end">
            {{-- SEARCH --}}
            <div class="col-lg-4">
                <label class="form-label fw-semibold">
                    Cari Pengurus
                </label>
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Cari nama pengurus..."
                        wire:model.debounce.500ms="search">
                    <i class="ri-search-line search-icon">
                    </i>
                </div>
            </div>
            {{-- GENDER --}}
            <div class="col-lg-3">
                <label class="form-label fw-semibold">
                    Jenis Kelamin
                </label>
                <select class="form-select" wire:model="gender">
                    <option value="">
                        Semua Gender
                    </option>
                    <option value="laki-laki">
                        Laki-laki
                    </option>
                    <option value="perempuan">
                        Perempuan
                    </option>
                </select>
            </div>
            {{-- DAPUKAN --}}
            <div class="col-lg-3">
                <label class="form-label fw-semibold">
                    Dapukan
                </label>
                <select class="form-select" wire:model="ms_dapukan_id">
                    <option value="">
                        Semua Dapukan
                    </option>
                    @foreach($listDapukan as $item)
                    <option value="{{ $item->ms_dapukan_id }}">
                        {{ $item->nama_dapukan }}
                    </option>
                    @endforeach
                </select>
            </div>
            {{-- Dapukan --}}
            <div class="col-lg-2">
                <button type="button" class="btn btn-light border w-100 rounded-pill" data-bs-toggle="modal"
                    data-bs-target="#DapukanCreate" wire:click="$emit('DapukanCreate')">
                    <i class="ri-add-circle-line me-1 text-primary">
                    </i>
                    Dapukan
                </button>
            </div>
        </div>
    </div>
    
    {{-- TABLE --}}
    <div class="card-body">
        <div class="table-responsive">
            <table id="Laporan" class="table table-hover align-middle table-nowrap mb-0">
                <thead class="table-light">
                    <tr class="text-uppercase fw-semibold">
                        <th width="50">#</th>
                        <th class="text-center" width="50">Hapus</th>
                        <th>Pengurus</th>
                        <th>Telepon</th>
                        <th>Kelompok</th>
                        <th>Usia</th>
                        <th>Dapukan</th>
                        <th class="text-center" width="170">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $item)
                    <tr>
                        <tr>
                            {{-- NO --}}
                            <td>
                                {{ $data->firstItem() + $index }}
                            </td>
                            <td class="text-center">
                                {{-- DELETE --}}
                                <a href="#PengurusDelete" data-bs-toggle="modal" class="btn btn-soft-danger btn-sm rounded-pill px-3"
                                    title="Hapus Data Pengurus" wire:click.prevent="$emit('PengurusDelete', {{ $item->ms_pengurus_id }})">
                                    <i class="ri-delete-bin-5-line me-1"></i>
                                    Hapus
                                </a>
                            </td>
                            {{-- PENGURUS --}}
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fw-semibold">
                                        {{ $item->nama_pengurus }}
                                    </span>
                                    <small class="text-muted">
                                        {{ ucfirst($item->jenis_kelamin ?? '-') }}
                                    </small>
                                </div>
                            </td>
                            {{-- TELEPON --}}
                            <td>
                                @if($item->telepon)
                                <div class="d-flex align-items-center text-success">
                                    <i class="ri-whatsapp-line me-2 fs-16">
                                    </i>
                                    <a href="https://wa.me/{{ $item->telepon }}" target="_blank" class="fw-medium text-success">
                                        {{ $item->telepon }}
                                    </a>
                                </div>
                                @else
                                    <span class="text-muted">
                                        -
                                    </span>
                                @endif
                            </td>
                            {{-- KELOMPOK --}}
                            <td>
                                <span class="badge bg-primary-subtle text-primary">
                                    {{ optional($item->ms_kelompok)->nama_kelompok ?? '-' }}
                                </span>
                            </td>
                            {{-- UMUR --}}
                            <td>
                                {{ $item->usia }} Tahun
                            </td>
                            <td>
                                @if($item->ms_penempatan_dapukan_count > 0)
                                <a href="#PenempatanDapukan" data-bs-toggle="modal"
                                    wire:click.prevent="$emit('PenempatanDapukan', {{ $item->ms_pengurus_id }})"
                                    class="btn btn-primary rounded-pill px-3">
                                    <i class="ri-shield-user-line me-1">
                                    </i>
                                    {{ $item->ms_penempatan_dapukan_count }} Dapukan
                                </a>
                                @else
                                <a href="#PenempatanDapukan" data-bs-toggle="modal"
                                    wire:click.prevent="$emit('PenempatanDapukan', {{ $item->ms_pengurus_id }})"
                                    class="btn btn-soft-primary rounded-pill px-3">
                                    <i class="ri-shield-user-line me-1">
                                    </i>
                                    Tambah Dapukan
                                </a>
                                @endif
                            </td>
                            {{-- AKSI --}}
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- DETAIL --}}
                                    <a href="#PengurusDetail" data-bs-toggle="modal" class="btn btn-sm btn-soft-primary border rounded-pill"
                                        wire:click.prevent="$emit('PengurusDetail', {{ $item->ms_pengurus_id }})">
                                        <i class="ri-eye-line me-1">
                                        </i>
                                        Detail
                                    </a>
                                    {{-- EDIT --}}
                                    <a href="#PengurusEdit" data-bs-toggle="modal" class="btn btn-primary btn-sm rounded-pill px-3"
                                        wire:click.prevent="$emit('PengurusEdit', {{ $item->ms_pengurus_id }})">
                                        <i class="ri-pencil-line me-1">
                                        </i>
                                        Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-md mb-3">
                                    <div class="avatar-title bg-light text-muted rounded-circle fs-2">
                                        <i class="ri-team-line"></i>
                                    </div>
                                </div>
                                <h6 class="fw-semibold mb-1">
                                    Belum Ada Data Pengurus
                                </h6>
                                <p class="text-muted mb-0 fs-13">
                                    Data Pengurus akan tampil di sini
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    
        {{-- PAGINATION --}}
        {{-- PAGINATION --}}
        <div class="mt-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="text-muted fs-13">
                    Menampilkan
                    <span class="fw-semibold">
                        {{ $data->firstItem() ?? 0 }}
                    </span>
                    -
                    <span class="fw-semibold">
                        {{ $data->lastItem() ?? 0 }}
                    </span>
                    dari
                    <span class="fw-semibold">
                        {{ $data->total() }}
                    </span>
                    data Pengurus
                </div>
                <div>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    
    </div>
</div>
