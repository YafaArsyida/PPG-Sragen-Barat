<div wire:ignore.self class="modal fade" id="JenjangEdit" tabindex="-1" aria-labelledby="JenjangEditLabel"
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
                            Edit Data Jenjang
                        </h5>
                        <small>
                            Perbarui informasi jenjang kurikulum generus
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
                    {{-- INFORMASI jenjang --}}
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                Informasi Jenjang
                            </span>
                        </div>
                        <div class="row g-4">
                            {{-- NAMA jenjang --}}
                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">
                                    Nama jenjang
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <input type="text" wire:model.defer="nama_jenjang"
                                    class="form-control @error('nama_jenjang') is-invalid @enderror"
                                    placeholder="Contoh : Juni 2026 atau Semester Ganjil 2026">
                                <small class="text-muted mt-1 d-block">
                                    Gunakan nama jenjang yang mudah dikenali pengurus daerah maupun kelompok
                                </small>
                                @error('nama_jenjang')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- INFORMASI --}}
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
                                    Jenjang akan digunakan dalam penyusunan aspek, materi, dan laporan kurikulum
                                    kelompok.
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