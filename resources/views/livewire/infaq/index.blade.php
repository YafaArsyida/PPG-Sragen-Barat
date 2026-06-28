<div class="modal fade" id="ModalInfaq" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="modal-header border-0 pb-0 p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-hand-coin-line"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Input Infaq</h5>
                        <small class="text-muted">Tambahkan nominal infaq kegiatan</small>
                    </div>
                </div>
                <button type="button" class="btn btn-light btn-icon rounded-circle" data-bs-dismiss="modal">
                    <i class="ri-close-line fs-18"></i>
                </button>
            </div>
            <div class="modal-body p-4">
                {{-- RIWAYAT INFAQ --}}
                <div class="card border-0 bg-light-subtle rounded-4 mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar-sm">
                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-22">
                                    <i class="ri-user-3-line">
                                    </i>
                                </div>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">
                                    {{ $nama_kegiatan ?? '-' }}
                                </h5>
                                <small>
                                {{ $tanggal_kegiatan ? \App\Http\Controllers\HelperController::formatTanggalIndonesia($tanggal_kegiatan, 'd F Y') : '-' }}
                                </small>
                            </div>
                        </div>
                    </div>
                    @if(count($listInfaq))
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                Riwayat Infaq
                            </span>
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                Total Rp {{ number_format($listInfaq->sum('nominal'), 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            @foreach($listInfaq as $i => $infaq)
                            <div class="border rounded-4 p-3 bg-white">
                                @if($editId != $infaq->tr_infaq_id)
                                <div class="d-flex justify-content-between align-items-start gap-3">
                                    <div class="d-flex align-items-start gap-2 flex-grow-1">
                                        {{-- <span class="fw-semibold text-muted" style="min-width:22px;">
                                        {{ $i + 1 }}.
                                        </span> --}}
                                        <div class="flex-grow-1">
                                            
                                            {{-- DESC --}} 
                                            <div class="fw-semibold fs-13">
                                                Rp {{ number_format($infaq->nominal,0,',','.') }}
                                            </div>
                                            <small class="text-muted">
                                                 {{ \App\Http\Controllers\HelperController::formatTanggalIndonesia($infaq->tanggal,'d F Y') }} | {{ $infaq->ms_pengguna->nama ?? '-' }}  @if($infaq->keterangan){{ $infaq->keterangan }}@endif
                                            </small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-primary btn-sm rounded-pill text-white" wire:click="edit({{ $infaq->tr_infaq_id }})">
                                                <i class="ri-pencil-line me-1"></i>
                                                Edit
                                            </button>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-light btn-sm rounded-circle"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ri-delete-bin-line text-danger">
                                                    </i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end border-1 shadow rounded-4 p-3"
                                                    style="min-width: 220px;">
                                                    <div class="text-center">
                                                        <div class="mb-2">
                                                            <div class="avatar-sm mx-auto">
                                                                <div
                                                                    class="avatar-title bg-danger-subtle text-danger rounded-circle">
                                                                    <i class="ri-delete-bin-line fs-20">
                                                                    </i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h6 class="fw-bold mb-1">
                                                            Hapus Infaq?
                                                        </h6>
                                                        <p class="text-muted fs-13 mb-3">
                                                            Infaq {{ $infaq->nominal }} akan dihapus permanen
                                                        </p>
                                                        <div class="d-flex gap-2">
                                                            <button type="button" class="btn btn-light btn-sm w-100"
                                                                data-bs-toggle="dropdown">
                                                                Tidak
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm w-100"
                                                                wire:click="delete({{ $infaq->tr_infaq_id }})">
                                                                Ya
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                {{-- EDIT MODE --}}
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">
                                        Tanggal
                                        </label>
                                        <input type="date" class="form-control" wire:model.defer="editForm.tanggal">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">
                                        Nominal
                                        </label>
                                        <input type="number" class="form-control" wire:model.defer="editForm.nominal">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">
                                        Keterangan
                                        </label>
                                        <textarea class="form-control" rows="1" wire:model.defer="editForm.keterangan"></textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <button type="button" class="btn btn-light rounded-pill px-4"
                                        wire:click="$set('editId', null)">
                                        Batal
                                    </button>
                                    <button type="button" class="btn btn-primary rounded-pill px-4 text-white"
                                        wire:click="update">
                                        <i class="ri-save-line me-1">
                                        </i>
                                        Simpan Perubahan
                                    </button>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                {{-- FORM INPUT --}}
                <form wire:submit.prevent="save">
                    <div class="d-flex flex-column gap-4">
                        @foreach($forms as $index => $item)
                        <div class="card border rounded-4 shadow-sm mb-0">
                            <div class="card-body">
                                {{-- HEADER --}}
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                                    Infaq #{{ $index + 1 }}
                                    </span>
                                    @if(count($forms) > 1)
                                    <button
                                        type="button"
                                        class="btn btn-light btn-sm rounded-circle"
                                        wire:click="removeForm({{ $index }})">
                                    <i class="ri-delete-bin-line text-danger"></i>
                                    </button>
                                    @endif
                                </div>
                                <div class="row g-4">
                                    {{-- TANGGAL --}}
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold">
                                        Tanggal
                                        </label>
                                        <input
                                            type="date"
                                            class="form-control"
                                            wire:model.defer="forms.{{ $index }}.tanggal">
                                        @error('forms.' . $index . '.tanggal')
                                        <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    {{-- NOMINAL --}}
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold">
                                        Nominal Infaq
                                        <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                            Rp
                                            </span>
                                            <input
                                                type="number"
                                                class="form-control"
                                                wire:model.defer="forms.{{ $index }}.nominal"
                                                placeholder="Masukkan nominal">
                                        </div>
                                        @error('forms.' . $index . '.nominal')
                                        <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    {{-- KETERANGAN --}}
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold">
                                        Keterangan
                                        </label>
                                        <textarea
                                            class="form-control"
                                            rows="1"
                                            wire:model.defer="forms.{{ $index }}.keterangan"
                                            placeholder="Catatan tambahan..."></textarea>
                                        @error('forms.' . $index . '.keterangan')
                                        <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{-- TAMBAH FORM --}}
                    <div class="mt-4">
                        <button
                            type="button"
                            class="btn btn-soft-primary rounded-pill px-4"
                            wire:click="addForm">
                        <i class="ri-add-line me-1"></i>
                        Tambah Infaq
                        </button>
                    </div>
                    {{-- FOOTER --}}
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button
                            type="button"
                            class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i>
                        Tutup
                        </button>
                        <button
                            type="submit"
                            class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="ri-save-3-line me-1"></i>
                        Simpan Infaq
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
