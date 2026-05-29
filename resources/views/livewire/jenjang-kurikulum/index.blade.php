<div class="card border-0 shadow-sm rounded-4 overflow-hidden" id="kegiatanGenerusList">
    {{-- HEADER --}}
    <div class="card-header bg-white border-0 p-4">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4">
            {{-- TITLE --}}
            <div>
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-calendar-event-line">
                            </i>
                        </div>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">
                            Jenjang Kurikulum
                        </h5>
                        <small>
                            Kelola data Jenjang kurikulum generus
                        </small>
                    </div>
                </div>
            </div>

            {{-- ACTION --}}
            <div class="d-flex gap-2 flex-wrap">

                {{-- TAMBAH --}}
                <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal"
                    data-bs-target="#JenjangCreate"
                    wire:click.prevent="$emit('JenjangCreate')">
                    <i class="ri-add-line me-1"></i>Tambah Jenjang
                </button>
            </div>
        </div>
    </div>

    {{-- FILTER --}}
    <div class="card-body border-top border-bottom bg-light-subtle">
        <div class="row g-3 align-items-end">
            {{-- SEARCH --}}
            <div class="col-12">
                <label class="form-label fw-semibold">
                    Cari Jenjang
                </label>
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Cari nama jenjang..."
                        wire:model.debounce.500ms="search">
                    <i class="ri-search-line search-icon">
                    </i>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card-body pt-3">
        <div class="table-responsive">
            <table id="Laporan" class="table table-hover align-middle table-nowrap mb-0">
                <thead class="table-light">
                    <tr class="text-uppercase fw-semibold">
                        <th class="text-center" width="50">No</th>
                        <th>Nama Jenjang</th>
                        <th class="text-center" width="170">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $index => $item)
                    <tr class="fw-semibold">
                        {{-- NO --}}
                        <td class="text-muted text-center align-middle">
                            {{ $data->firstItem() + $index }}
                        </td>
                        {{-- NAMA PERIODE --}}
                        <td class="align-middle">
                            <div class="fw-bold text-dark">
                                <i class="ri-book-open-line text-primary me-1">
                                </i>
                                {{ $item->nama_jenjang }}
                            </div>
                            <small class="">
                                {{ $item->deskripsi }}
                            </small>
                        </td>
                        {{-- AKSI --}}
                        <td class="text-center align-middle">
                            <div class="d-flex justify-content-center gap-2">
                                {{-- EDIT --}}
                                {{-- EDIT --}}
                                <button type="button" class="btn btn-primary btn-sm rounded-pill px-3" data-bs-toggle="modal"
                                    data-bs-target="#JenjangEdit" wire:click="$emit('JenjangEdit', {{ $item->ms_jenjang_kurikulum_id }})">
                                    <i class="ri-pencil-line me-1"></i>
                                    Edit
                                </button>
                                {{-- DELETE --}}
                                <button type="button" class="btn btn-soft-danger btn-sm rounded-pill px-3" data-bs-toggle="modal"
                                    data-bs-target="#JenjangDelete" wire:click="$emit('JenjangDelete', {{ $item->ms_jenjang_kurikulum_id }})">
                                    <i class="ri-delete-bin-line me-1"></i>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-md mb-3">
                                    <div class="avatar-title bg-light text-muted rounded-circle fs-2">
                                        <i class="ri-calendar-event-line">
                                        </i>
                                    </div>
                                </div>
                                <h6 class="fw-semibold mb-1">
                                    Belum ada data periode kurikulum
                                </h6>
                                <p class="text-muted mb-0 fs-13">
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

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
                    data Jenjang
                </div>
                <div>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>