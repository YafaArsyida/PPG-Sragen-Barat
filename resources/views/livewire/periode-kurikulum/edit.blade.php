<div wire:ignore.self class="modal fade" id="PeriodeEdit" tabindex="-1" aria-labelledby="PeriodeEditLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="modal-header border-0 pb-0 p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-edit-2-line">
                            </i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">
                            Edit Data Periode
                        </h5>
                        <small>
                            Perbarui informasi periode kurikulum generus
                        </small>
                    </div>
                </div>
                <button type="button" class="btn btn-light btn-icon rounded-circle" data-bs-dismiss="modal">
                    <i class="ri-close-line fs-18">
                    </i>
                </button>
            </div>
            <form wire:submit.prevent="update">
                <div class="modal-body p-4">
                    {{-- INFORMASI PERIODE --}}
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                Informasi Periode
                            </span>
                        </div>
                        <div class="row g-4">
                            {{-- NAMA PERIODE --}}
                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">
                                    Nama Periode
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <input type="text" wire:model.defer="nama_periode"
                                    class="form-control @error('nama_periode') is-invalid @enderror"
                                    placeholder="Contoh : Juni 2026 atau Semester Ganjil 2026">
                                <small class="text-muted mt-1 d-block">
                                    Gunakan nama periode yang mudah dikenali pengurus daerah maupun kelompok
                                </small>
                                @error('nama_periode')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            {{-- TANGGAL MULAI --}}
                            <div class="col-lg-6">
                                <label class="form-label fw-semibold">
                                    Tanggal Mulai
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <input type="date" wire:model.defer="tanggal_mulai"
                                    class="form-control @error('tanggal_mulai') is-invalid @enderror">
                                @error('tanggal_mulai')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            {{-- TANGGAL SELESAI --}}
                            <div class="col-lg-6">
                                <label class="form-label fw-semibold">
                                    Tanggal Selesai
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <input type="date" wire:model.defer="tanggal_selesai"
                                    class="form-control @error('tanggal_selesai') is-invalid @enderror">
                                @error('tanggal_selesai')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- INFORMASI TAMBAHAN --}}
                    <div class="alert alert-light border">
                        <div class="d-flex align-items-start gap-3">
                            <div class="fs-20 text-primary">
                                <i class="ri-information-line">
                                </i>
                            </div>
                            <div>
                                <div class="fw-semibold text-body mb-1">
                                    Informasi
                                </div>
                                <small class="text-muted">
                                    Status periode akan otomatis dibuat sebagai
                                    <span class="fw-semibold text-body">
                                        Aktif
                                    </span>
                                    dan dapat diubah setelah aspek serta materi kurikulum selesai disusun.
                                </small>
                            </div>
                        </div>
                    </div>
                    {{-- DESKRIPSI --}}
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                Deskripsi Tambahan
                            </span>
                        </div>
                        {{-- Deskripsi --}}
                        <div>
                            <label class="form-label fw-semibold">
                                Deskripsi
                            </label>
                            <textarea wire:model.defer="deskripsi" class="form-control" rows="2"
                                placeholder="Tambahkan catatan atau informasi tambahan"></textarea>
                            @error('deskripsi')
                            <small class="text-danger d-block mt-1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- FOOTER --}}
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1">
                        </i>
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 text-white">
                        <i class="ri-save-3-line me-1">
                        </i>
                        Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>