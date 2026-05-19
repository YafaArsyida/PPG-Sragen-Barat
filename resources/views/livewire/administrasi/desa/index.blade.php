<div>
    <div class="row g-3 align-items-end">
        {{-- SEARCH --}}
        <div class="col-xxl-8 col-lg-7">
            <label class="form-label fw-semibold">
                Pencarian Desa
            </label>
            <div class="position-relative">
                <input type="text" class="form-control ps-5" wire:model.debounce.300ms="search"
                    placeholder="Cari nama desa, masjid, atau informasi lainnya...">
                <i class="ri-search-line position-absolute top-50 start-0 translate-middle-y ms-3 text-muted fs-18">
                </i>
            </div>
        </div>
        {{-- BUTTON --}}
        <div class="col-xxl-4 col-lg-5">
            <button type="button" class="btn btn-primary w-100 rounded-pill" data-bs-toggle="modal"
                data-bs-target="#ModalDesaCreate" wire:click="$emit('DesaCreate')">
                <i class="ri-add-line me-1">
                </i>
                Tambah
            </button>
        </div>
    </div>
    <div class="row mt-3">
        {{-- TABLE --}}
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr class="text-uppercase fw-semibold">
                        <th width="70" class="text-center">
                            Hapus
                        </th>
                        <th class="">
                            Informasi Desa
                        </th>
                        <th width="220" class="text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $kat)
                    <tr>
                        {{-- NO --}}
                        {{-- <td class="text-center">
                            <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                                {{ $index + 1 }}
                            </span>
                        </td> --}}
                        {{-- HAPUS --}}
                        <td class="text-center">
                            {{-- DELETE --}}
                            <a href="#ModalDeleteDesa" data-bs-toggle="modal"
                                class="btn btn-soft-danger btn-sm rounded-pill" title="Hapus Data Generus"
                                wire:click.prevent="$emit('DesaDelete', {{ $kat->ms_desa_id }})">
                                <i class="ri-delete-bin-5-line"></i>
                                {{-- Hapus --}}
                            </a>
                        </td>
                        {{-- INFORMASI --}}
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-xs flex-shrink-0">
                                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-14">
                                        <i class="ri-community-line">
                                        </i>
                                    </div>
                                </div>
                                <div>
                                    <div class="fw-semibold mb-1">
                                        Desa {{ $kat->nama_desa }}
                                    </div>
                                    <small>
                                        {{ $kat->nama_masjid ?? 'Masjid belum tersedia' }}
                                    </small>
                                </div>
                            </div>
                        </td>
                        {{-- ACTION --}}
                        <td>
                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                {{-- DETAIL --}}
                                <a href="#ModalDetailDesa" data-bs-toggle="modal" class="btn btn-light btn-sm rounded-pill"
                                    wire:click.prevent="$emit('detailDesa', {{ $kat->ms_desa_id }})">
                                    <i class="ri-eye-line me-1">
                                    </i>
                                    Detail
                                </a>
                                {{-- EDIT --}}
                                <a href="#ModalEditDesa" data-bs-toggle="modal"
                                    class="btn btn-warning btn-sm rounded-pill text-white"
                                    wire:click.prevent="$emit('loadDataDesa', {{ $kat->ms_desa_id }})">
                                    <i class="ri-pencil-line me-1">
                                    </i>
                                    Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">
                            <div class="text-center py-5">
                                <div class="mb-3">
                                    <i class="ri-inbox-2-line text-muted" style="font-size: 48px;">
                                    </i>
                                </div>
                                <h5 class="fw-semibold mb-1">
                                    Data desa kosong
                                </h5>
                                <p class="text-muted mb-0">
                                    Belum ada data desa yang tersedia
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