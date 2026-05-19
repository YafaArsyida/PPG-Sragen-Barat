<div wire:ignore.self class="modal fade" id="PenempatanDapukan" tabindex="-1" aria-labelledby="PenempatanDapukanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="modal-header align-items-center border-0 pb-0 p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-shield-user-line">
                            </i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1" id="PenempatanDapukanLabel">
                            Penempatan Dapukan
                        </h5>
                        <small>
                            Atur penempatan jabatan pengurus
                        </small>
                    </div>
                </div>
                <button type="button" class="btn btn-light btn-icon rounded-circle" data-bs-dismiss="modal">
                    <i class="ri-close-line fs-18">
                    </i>
                </button>
            </div>
            <form wire:submit.prevent="save">
                <div class="modal-body p-4">
                    {{-- PENGURUS --}}
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
                                        {{ $pengurus->nama_pengurus ?? '-' }}
                                    </h5>
                                    <small>
                                        {{ $pengurus->usia ?? '-' }} Tahun
                                    </small>
                                </div>
                            </div>
                        </div>
                        @if(count($listPenempatan) > 0)
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                    Penempatan Saat Ini
                                </span>
                            </div>
                            <div class="d-flex flex-column gap-3">
                                @foreach($listPenempatan as $item)
                                <div class="border rounded-4 p-3 bg-white">
                                    @if($editId != $item->ms_penempatan_dapukan_id) {{-- VIEW MODE --}}
                                    <div class="d-flex justify-content-between align-items-start gap-3">
                                        <div class="flex-grow-1">
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
                                            <h6 class="fw-bold mb-1">
                                                {{ $item->nama_penempatan }}
                                            </h6>
                                            {{-- DESC --}} @if($item->deskripsi)
                                            <div class="text-muted fs-13">
                                                {{ $item->deskripsi }}
                                            </div>
                                            @endif
                                        </div>
                                        {{-- ACTION --}}
                                        <div class="d-flex align-items-center gap-2">
                                            {{-- EDIT --}}
                                            <button type="button" class="btn btn-primary btn-sm rounded-pill text-white"
                                                wire:click="edit({{ $item->ms_penempatan_dapukan_id }})">
                                                <i class="ri-pencil-line me-1">
                                                </i> Edit
                                            </button>
                                            {{-- DELETE --}}
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
                                                            Hapus Dapukan?
                                                        </h6>
                                                        <p class="text-muted fs-13 mb-3">
                                                            {{ $item->nama_penempatan }} akan dihapus permanen
                                                        </p>
                                                        <div class="d-flex gap-2">
                                                            <button type="button" class="btn btn-light btn-sm w-100"
                                                                data-bs-toggle="dropdown">
                                                                Tidak
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm w-100"
                                                                wire:click="delete({{ $item->ms_penempatan_dapukan_id }})">
                                                                Ya
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else {{-- EDIT MODE --}}
                                    <div>
                                        {{-- HEADER --}}
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                                Edit Penempatan
                                            </span>
                                            <button type="button" class="btn btn-light btn-sm rounded-circle"
                                                wire:click="$set('editId', null)">
                                                <i class="ri-close-line">
                                                </i>
                                            </button>
                                        </div>
                                        <div class="row g-4">
                                            {{-- DAPUKAN --}}
                                            <div class="col-lg-4">
                                                <label class="form-label fw-semibold">
                                                    Dapukan
                                                </label>
                                                <select class="form-select" wire:model="editForm.ms_dapukan_id">
                                                    <option value="">
                                                        Pilih Dapukan
                                                    </option>
                                                    @foreach($listDapukan as $dapukan)
                                                    <option value="{{ $dapukan->ms_dapukan_id }}">
                                                        {{ $dapukan->nama_dapukan }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{-- NAMA --}}
                                            <div class="col-lg-4">
                                                <label class="form-label fw-semibold">
                                                    Nama Penempatan
                                                </label>
                                                <input type="text" class="form-control"
                                                    wire:model.defer="editForm.nama_penempatan">
                                            </div>
                                            {{-- DESKRIPSI --}}
                                            <div class="col-lg-4">
                                                <label class="form-label fw-semibold">
                                                    Deskripsi
                                                </label>
                                                <textarea class="form-control" rows="1"
                                                    wire:model.defer="editForm.deskripsi">
                                        </textarea>
                                            </div>
                                        </div>
                                        {{-- FOOTER --}}
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
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                    {{-- FORM --}}
                    <div class="d-flex flex-column gap-4">
                        @foreach($forms as $index => $item)
                        <div class="card border rounded-4 shadow-sm mb-0">
                            <div class="card-body">
                                {{-- HEADER --}}
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div>
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                                            Penempatan #{{ $index + 1 }}
                                        </span>
                                    </div>
                                    @if(count($forms) > 1)
                                    <button type="button" class="btn btn-light btn-sm rounded-circle"
                                        wire:click="removeForm({{ $index }})">
                                        <i class="ri-delete-bin-line text-danger">
                                        </i>
                                    </button>
                                    @endif
                                </div>
                                <div class="row g-4">
                                    {{-- DAPUKAN --}}
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold">
                                            Dapukan
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        <select class="form-select" wire:model="forms.{{ $index }}.ms_dapukan_id">
                                            <option value="">
                                                Pilih Dapukan
                                            </option>
                                            @foreach($listDapukan as $dapukan)
                                            <option value="{{ $dapukan->ms_dapukan_id }}">
                                                {{ $dapukan->nama_dapukan }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('forms.' . $index . '.ms_dapukan_id')
                                        <small class="text-danger d-block mt-1">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    {{-- NAMA --}}
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold">
                                            Nama Penempatan
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" placeholder="Contoh : Ketua PPG"
                                            wire:model.defer="forms.{{ $index }}.nama_penempatan">
                                        @error('forms.' . $index . '.nama_penempatan')
                                        <small class="text-danger d-block mt-1">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    {{-- STATUS --}}
                                    {{-- <div class="col-lg-4">
                                        <label class="form-label fw-semibold">
                                            Status
                                        </label>
                                        <select class="form-select" wire:model="forms.{{ $index }}.status">
                                            <option value="aktif">
                                                Aktif
                                            </option>
                                            <option value="nonaktif">
                                                Nonaktif
                                            </option>
                                        </select>
                                    </div> --}}
                                    {{-- DESKRIPSI --}}
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold">
                                            Deskripsi
                                        </label>
                                        <textarea class="form-control" rows="1"
                                            wire:model.defer="forms.{{ $index }}.deskripsi"
                                            placeholder="Tambahkan catatan penempatan"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{-- ADD --}}
                    <div class="mt-4">
                        <button type="button" class="btn btn-soft-primary rounded-pill px-4" wire:click="addForm">
                            <i class="ri-add-line me-1">
                            </i>
                            Tambah Dapukan
                        </button>
                    </div>
                </div>
                {{-- FOOTER --}}
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1">
                        </i>
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="ri-save-3-line me-1">
                        </i>
                        Simpan Penempatan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>