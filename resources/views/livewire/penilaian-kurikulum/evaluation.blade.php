<div class="d-flex flex-column gap-3">
    @forelse($this->data as $item) 
    @php 
        $penilaian = $item->trx_penilaian_materi->first();
    @endphp 
    {{-- EDIT MODE --}} 
    @if($editId === $item->ms_materi_kurikulum_id)
    <div class="border rounded-4 p-4 bg-light-subtle">
        <div class="d-flex align-items-start gap-3">
            {{-- ICON --}}
            <div class="text-warning fs-20 mt-1">
                <i class="ri-edit-2-line">
                </i>
            </div>
            <div class="flex-grow-1">
                {{-- TITLE --}}
                <div class="fw-bold mb-1">
                    {{ $item->urutan }}. {{ $item->nama_materi }}
                </div>
                @if($item->uraian_materi)
                <small class="text-muted d-block mb-3">
                    {{ $item->uraian_materi }}
                </small>
                @endif {{-- FORM --}}
                <div class="row g-3">
                    {{-- KEHADIRAN --}}
                    <div class="col-lg-3">
                        <label class="form-label fw-semibold">
                            Kehadiran (%)
                        </label>
                        <input type="number" wire:model.defer="editForm.kehadiran"
                            class="form-control @error('editForm.kehadiran') is-invalid @enderror"
                            placeholder="0 - 100">
                        @error('editForm.kehadiran')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    {{-- KEBERHASILAN --}}
                    <div class="col-lg-3">
                        <label class="form-label fw-semibold">
                            Keberhasilan (%)
                        </label>
                        <input type="number" wire:model.defer="editForm.keberhasilan"
                            class="form-control @error('editForm.keberhasilan') is-invalid @enderror"
                            placeholder="0 - 100">
                        @error('editForm.keberhasilan')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    {{-- CATATAN --}}
                    <div class="col-lg-6">
                        <label class="form-label fw-semibold">
                            Catatan Pembinaan
                        </label>
                        <textarea rows="1" wire:model.defer="editForm.catatan"
                            class="form-control @error('editForm.catatan') is-invalid @enderror"
                            placeholder="Tambahkan evaluasi atau catatan">
                        </textarea>
                        @error('editForm.catatan')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                </div>
                {{-- ACTION --}}
                <div class="d-flex align-items-center gap-2 mt-3">
                    <button type="button" wire:click="update" class="btn btn-primary rounded-pill px-4">
                        <i class="ri-save-3-line me-1">
                        </i>
                        Simpan Penilaian
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
    <div class="border rounded-4 p-3">
        <div class="d-flex justify-content-between align-items-start gap-3">
            {{-- LEFT --}}
            <div class="d-flex align-items-start gap-3 flex-grow-1">
                {{-- ICON --}}
                <div class="text-primary fs-20 mt-1">
                    <i class="ri-book-2-line">
                    </i>
                </div>
                {{-- CONTENT --}}
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <div class="fw-semibold">
                            {{ $item->urutan }}. {{ $item->nama_materi }}
                        </div>
                        @if($penilaian)
                        <span class="badge bg-success-subtle text-success">
                            Sudah Dinilai
                        </span>
                        @else
                        <span class="badge bg-warning-subtle text-warning">
                            Belum Dinilai
                        </span>
                        @endif
                    </div>
                    @if($item->uraian_materi)
                    <small class="text-muted d-block mt-1">
                        {{ $item->uraian_materi }}
                    </small>
                    @endif {{-- HASIL --}} 
                    @if($penilaian)
                    <div class="mt-4">
                        {{-- SUMMARY --}}
                       <div class="row g-3">
                            {{-- KEHADIRAN --}}
                            <div class="col-lg-3 col-6">
                                <div class="border rounded-4 p-3 h-100 bg-primary-subtle border-primary-subtle">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <small class="text-muted fw-semibold">
                                            Kehadiran
                                        </small>
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-white text-primary">
                                                <i class="ri-user-follow-line">
                                                </i>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="fw-bold text-primary mb-0">
                                        {{ $penilaian->kehadiran }}%
                                    </h4>
                                    <small class="text-muted">
                                        Tingkat kehadiran generus
                                    </small>
                                </div>
                            </div>
                            {{-- KEBERHASILAN --}}
                            <div class="col-lg-3 col-6">
                                <div class="border rounded-4 p-3 h-100 bg-success-subtle border-success-subtle">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <small class="text-muted fw-semibold">
                                            Keberhasilan
                                        </small>
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-white text-success">
                                                <i class="ri-award-line">
                                                </i>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="fw-bold text-success mb-0">
                                        {{ $penilaian->keberhasilan }}%
                                    </h4>
                                    <small class="text-muted">
                                        Capaian pemahaman materi
                                    </small>
                                </div>
                            </div>
                            {{-- CATATAN --}}
                            <div class="col-lg-4">
                                <div class="border rounded-4 p-3 h-100">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <div class="text-warning">
                                            <i class="ri-sticky-note-line">
                                            </i>
                                        </div>
                                        <small class="fw-semibold text-muted">
                                            Catatan Pembinaan
                                        </small>
                                    </div>
                                    @if($penilaian->catatan)
                                    <p class="mb-0 text-muted lh-base fs-13">
                                        {{ $penilaian->catatan }}
                                    </p>
                                    @else
                                    <small class="text-muted fst-italic">
                                        Tidak ada catatan tambahan
                                    </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            {{-- ACTION --}}
            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3"
                wire:click="edit({{ $item->ms_materi_kurikulum_id }})">
                <i class="ri-flashlight-line me-1">
                </i>
                {{ $penilaian ? 'Edit' : 'Input Penilaian' }}
            </button>
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
            Materi pembelajaran belum tersedia pada aspek ini.
        </p>
    </div>
    @endforelse
</div>