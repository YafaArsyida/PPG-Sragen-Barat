<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
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
                            Petugas Administrasi
                        </h5>
                        <small>
                            Kelola akun petugas, akses sistem, dan keamanan pengguna aplikasi.
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
    
                {{-- TAMBAH --}}
                <button type="button" class="btn btn-success rounded-pill px-4" data-bs-toggle="modal"
                    data-bs-target="#ModalAddPengguna" wire:click.prevent="$emit('openCreatePengguna')">
                    <i class="ri-add-line me-1"></i>Petugas Baru
                </button>
            </div>
        </div>
    </div>
    {{-- FILTER --}}
    <div class="card-body border-top border-bottom bg-light-subtle">
        <div class="row g-3 align-items-end">
            <div class="col-12">
                <label class="form-label fw-semibold">
                    Pencarian Pengguna
                </label>
                <div class="search-box">
                    <input type="text" class="form-control"
                        wire:model.debounce.300ms="search" placeholder="Cari nama, email, telepon, atau lainnya...">
                    <i class="ri-search-line search-icon">
                    </i>
                </div>
            </div>
        </div>
    </div>
    {{-- TABLE --}}
    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead class="table-light">
                    <tr class="text-uppercase fw-semibold">
                        <th width="60" class="ps-4">#</th>
                        <th width="50" class="text-center">Hapus</th>
                        <th>Petugas</th>
                        <th>Username</th>
                        <th>Telepon</th>
                        <th>Peran</th>
                        <th>Akses</th>
                        <th width="240" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengguna as $index => $user)
                    <tr class="fw-medium">
                        {{-- NO --}}
                        <td class="ps-4">
                            <span class="text-muted">
                                {{ $index + 1 }}
                            </span>
                        </td>
                        <td class="text-center">
                            {{-- DELETE --}}
                            <a href="#ModalDeletePengguna" data-bs-toggle="modal" class="btn btn-sm btn-soft-danger rounded-pill"
                                wire:click.prevent="$emit('deletePengguna', {{ $user['ms_pengguna_id'] }})">
                                <i class="ri-delete-bin-6-line">
                                </i>
                            </a>
                        </td>
                        {{-- PETUGAS --}}
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-xs flex-shrink-0">
                                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle fw-semibold">
                                        {{ strtoupper(substr($user['nama'], 0, 1)) }}
                                    </div>
                                </div>
                                <div>
                                    <div class="fw-semibold">
                                        {{ $user['nama'] }}
                                    </div>
                                    <small class="text-muted">
                                        ID Pengguna
                                    </small>
                                </div>
                            </div>
                        </td>
                        {{-- USERNAME --}}
                        <td>
                            <span class="badge bg-light text-body border fw-medium px-3 py-2">
                                {{ $user['email'] }}
                            </span>
                        </td>
                        {{-- TELEPON --}}
                        <td>
                            @if($user['telepon'])
                            <span class="text-body">
                                {{ $user['telepon'] }}
                            </span>
                            @else
                            <span class="text-muted">
                                -
                            </span>
                            @endif
                        </td>
                        {{-- PERAN --}}
                        <td>
                            @php $roleClass = match($user['peran']) { 'superadmin' => 'bg-danger-subtle
                            text-danger', 'admin' => 'bg-primary-subtle text-primary', 'petugas' =>
                            'bg-success-subtle text-success', default => 'bg-light text-body' }; @endphp
                            <span class="badge {{ $roleClass }} px-3 py-2 text-uppercase fw-semibold">
                                {{ $user['peran'] }}
                            </span>
                        </td>
                        {{-- AKSES --}}
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                @foreach($user['aksesPengguna'] as $akses)
                                <span class="badge bg-soft-secondary text-secondary">
                                    {{ $akses }}
                                </span>
                                @endforeach
                            </div>
                        </td>
                        {{-- AKSI --}}
                        <td style="white-space: nowrap">
                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                {{-- DETAIL --}}
                                <a href="#ModalDetailPengguna" data-bs-toggle="modal"
                                    class="btn btn-sm btn-light border rounded-pill"
                                    wire:click.prevent="$emit('detailPengguna', {{ $user['ms_pengguna_id'] }})">
                                    <i class="ri-eye-line me-1">
                                    </i>
                                    Detail
                                </a>
                                {{-- EDIT --}}
                                <a href="#ModalEditPengguna" data-bs-toggle="modal"
                                    class="btn btn-warning btn-sm rounded-pill px-3"
                                    wire:click.prevent="$emit('editPengguna', {{ $user['ms_pengguna_id'] }})">
                                    <i class="ri-pencil-line me-1">
                                    </i>
                                    Edit
                                </a>
                                {{-- RESET --}}
                                <a href="#ModalKonfirmasiReset" data-bs-toggle="modal"
                                    class="btn btn-sm btn-danger rounded-pill px-3"
                                    wire:click.prevent="$emit('resetPassword', {{ $user['ms_pengguna_id'] }})">
                                    <i class="ri-lock-unlock-line me-1">
                                    </i>
                                    Reset
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="text-center py-5">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                    colors="primary:#405189,secondary:#0ab39c" style="width:90px;height:90px">
                                </lord-icon>
                                <h5 class="mt-3 fw-semibold">
                                    Tidak Ada Data Pengguna
                                </h5>
                                <p class="text-muted mb-0">
                                    Belum ditemukan data petugas yang sesuai dengan pencarian.
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>