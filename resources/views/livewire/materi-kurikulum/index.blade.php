<div class="d-flex flex-column gap-3">
    {{-- LIST DATA --}} 
    @forelse($this->data as $item) {{-- EDIT MODE --}}
    @if($editId === $item->ms_materi_kurikulum_id)
    <div class="border rounded-4 p-4 bg-light-subtle">
        <div class="d-flex align-items-start gap-3">
            {{-- ICON --}}
            <div class="text-warning fs-20 mt-1">
                <i class="ri-edit-2-line">
                </i>
            </div>
            <div class="flex-grow-1">
                <div class="row g-3">
                    {{-- NAMA --}}
                    <div class="col-lg-4">
                        <label class="form-label fw-semibold">
                            Nama Materi
                        </label>
                        <input type="text" wire:model.defer="editForm.nama_materi"
                            class="form-control @error('editForm.nama_materi') is-invalid @enderror"
                            placeholder="Contoh : Mengenal Allah SWT">
                        @error('editForm.nama_materi')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    {{-- URUTAN --}}
                    <div class="col-lg-2">
                        <label class="form-label fw-semibold">
                            Urutan
                        </label>
                        <input type="number" wire:model.defer="editForm.urutan" class="form-control">
                    </div>
                    {{-- URAIAN --}}
                    <div class="col-lg-6">
                        <label class="form-label fw-semibold">
                            Uraian Materi
                        </label>
                        <textarea rows="1" wire:model.defer="editForm.uraian_materi" class="form-control" placeholder="Tambahkan uraian singkat materi"></textarea>
                    </div>
                </div>
                {{-- ACTION --}}
                <div class="d-flex align-items-center gap-2 mt-3">
                    <button type="button" wire:click="update" class="btn btn-primary rounded-pill px-4">
                        <i class="ri-save-3-line me-1">
                        </i>
                        Simpan
                    </button>
                    <button type="button" wire:click="cancelEdit" class="btn btn-light rounded-pill px-4">
                        <i class="ri-close-line me-1">
                        </i>
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- VIEW MODE --}} 
    @else
    <div class="border rounded-4 px-3 py-3">
        <div class="d-flex justify-content-between align-items-center">
            {{-- LEFT --}}
            <div class="d-flex align-items-center gap-3">
                {{-- ICON --}}
                <div class="text-primary fs-20">
                    <i class="ri-book-2-line">
                    </i>
                </div>
                {{-- CONTENT --}}
                <div>
                    <div class="fw-semibold">
                        {{ $item->urutan }}. {{ $item->nama_materi }}
                    </div>
                    @if($item->uraian_materi)
                    <small class="text-muted d-block mt-1">
                        {{ $item->uraian_materi }}
                    </small>
                    @endif
                </div>
            </div>
            {{-- ACTION --}}
            <div class="d-flex align-items-center gap-2">
                {{-- EDIT --}}
                <button type="button" class="btn btn-primary btn-sm rounded-pill"
                    wire:click="edit({{ $item->ms_materi_kurikulum_id }})">
                    <i class="ri-pencil-line me-1">
                    </i>
                    Edit
                </button>
                {{-- DELETE --}}
                <div class="dropdown">
                    <button type="button" class="btn btn-light btn-sm rounded-circle" data-bs-toggle="dropdown">
                        <i class="ri-delete-bin-line text-danger">
                        </i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end border-1 shadow rounded-4 p-3" style="min-width: 240px;">
                        <div class="text-center">
                            {{-- ICON --}}
                            <div class="mb-2">
                                <div class="avatar-sm mx-auto">
                                    <div class="avatar-title bg-danger-subtle text-danger rounded-circle">
                                        <i class="ri-delete-bin-line fs-20">
                                        </i>
                                    </div>
                                </div>
                            </div>
                            {{-- TITLE --}}
                            <h6 class="fw-bold mb-1">
                                Hapus Materi?
                            </h6>
                            {{-- DESC --}}
                            <p class="text-muted fs-13 mb-3">
                                {{ $item->nama_materi }} akan dihapus permanen
                            </p>
                            {{-- ACTION --}}
                            <div class="d-flex gap-2">
                                {{-- CANCEL --}}
                                <button type="button" class="btn btn-light btn-sm w-100">
                                    Tidak
                                </button>
                                {{-- DELETE --}}
                                <button type="button" class="btn btn-danger btn-sm w-100"
                                    wire:click="delete({{ $item->ms_materi_kurikulum_id }})">
                                    Ya
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif 
    @empty {{-- EMPTY --}}
    <div class="border border-dashed rounded-4 p-4 text-center">
        <div class="avatar-md mx-auto mb-3">
            <div class="avatar-title bg-light text-muted rounded-circle">
                <i class="ri-book-open-line fs-3">
                </i>
            </div>
        </div>
        <h6 class="fw-semibold mb-1">
            Belum Ada Materi
        </h6>
        <p class="text-muted mb-0 fs-13">
            Tambahkan materi pembelajaran pada aspek ini.
        </p>
    </div>
    @endforelse 
    {{-- CREATE FORM --}} 
    @foreach($forms as $index => $form)
    <div class="border border-primary-subtle rounded-4 p-4 bg-primary-subtle bg-opacity-10">
        <div class="d-flex align-items-start gap-3">
            {{-- ICON --}}
            <div class="text-primary fs-20 mt-1">
                <i class="ri-add-circle-line">
                </i>
            </div>
            <div class="flex-grow-1">
                <div class="row g-3">
                    {{-- NAMA --}}
                    <div class="col-lg-4">
                        <label class="form-label fw-semibold">
                            Nama Materi
                        </label>
                        <input type="text" wire:model.defer="forms.{{ $index }}.nama_materi"
                            class="form-control @error('forms.'.$index.'.nama_materi') is-invalid @enderror"
                            placeholder="Contoh : Mengenal Allah SWT">
                        @error('forms.'.$index.'.nama_materi')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    {{-- URUTAN --}}
                    <div class="col-lg-2">
                        <label class="form-label fw-semibold">
                            Urutan
                        </label>
                        <input type="number" wire:model.defer="forms.{{ $index }}.urutan" class="form-control">
                    </div>
                    {{-- URAIAN --}}
                    <div class="col-lg-6">
                        <label class="form-label fw-semibold">
                            Uraian Materi
                        </label>
                        <textarea rows="1" wire:model.defer="forms.{{ $index }}.uraian_materi" class="form-control" placeholder="Tambahkan uraian singkat materi"></textarea>
                    </div>
                </div>
                {{-- ACTION --}}
                <div class="d-flex align-items-center gap-2 mt-3">
                    {{-- REMOVE --}} @if(count($forms) > 1)
                    <button type="button" wire:click="removeForm({{ $index }})"
                        class="btn btn-soft-danger rounded-pill px-4">
                        <i class="ri-delete-bin-line me-1">
                        </i>
                        Hapus Form
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach {{-- SAVE --}} 
    @if(count($forms))
    <div class="d-flex align-items-center gap-2 pt-2">
        {{-- ADD FORM --}}
        <button type="button" wire:click="addForm" class="btn btn-light rounded-pill px-4">
            <i class="ri-add-line me-1">
            </i>
            Tambah Form
        </button>
        <button type="button" wire:click="save" class="btn btn-primary rounded-pill px-4">
            <i class="ri-save-3-line me-1">
            </i>
            Simpan Materi
        </button>
    </div>
    @endif
</div>