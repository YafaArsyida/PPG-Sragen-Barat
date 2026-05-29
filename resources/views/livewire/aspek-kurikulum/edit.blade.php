<div wire:ignore.self class="modal fade" id="AspekEdit" tabindex="-1" aria-labelledby="AspekEditLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="modal-header border-0 pb-0 p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-pencil-line">
                            </i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">
                            Edit Aspek Kurikulum
                        </h5>
                        <small class="text-muted">
                            Perbarui informasi aspek pembinaan generus
                        </small>
                    </div>
                </div>
                <button type="button" class="btn btn-light btn-icon rounded-circle" data-bs-dismiss="modal">
                    <i class="ri-close-line fs-18">
                    </i>
                </button>
            </div>
            {{-- FORM --}}
            <form wire:submit.prevent="update">
                <div class="modal-body p-4">
                    {{-- KETERANGAN --}}
                    <div class="alert alert-light border mb-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="fs-20 text-primary">
                                <i class="ri-information-line">
                                </i>
                            </div>
                            <div>
                                <div class="fw-semibold text-body mb-1">
                                    Konteks Kurikulum
                                </div>
                                <small class="text-muted">
                                    Aspek berada pada:
                                    <span class="fw-semibold text-body">
                                        {{ $periode?->nama_periode ?? '-' }}
                                    </span>
                                    •
                                    <span class="fw-semibold text-body">
                                        {{ $jenjang?->nama_jenjang ?? '-' }}
                                    </span>
                                </small>
                            </div>
                        </div>
                    </div>
                    {{-- INFORMASI --}}
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                Informasi Aspek
                            </span>
                        </div>
                        <div class="row g-4">
                            {{-- NAMA --}}
                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">
                                    Nama Aspek
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <input type="text" wire:model.defer="nama_aspek"
                                    class="form-control @error('nama_aspek') is-invalid @enderror"
                                    placeholder="Contoh : Aqidah, Adab, Ibadah">
                                <small class="text-muted mt-1 d-block">
                                    Gunakan nama aspek yang jelas dan mudah dipahami
                                </small>
                                @error('nama_aspek')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            {{-- URUTAN --}}
                            <div class="col-lg-4">
                                <label class="form-label fw-semibold">
                                    Urutan
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <input type="number" min="1" wire:model.defer="urutan"
                                    class="form-control @error('urutan') is-invalid @enderror">
                                @error('urutan')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
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
                        <div>
                            <label class="form-label fw-semibold">
                                Deskripsi
                            </label>
                            <textarea wire:model.defer="deskripsi" class="form-control" rows="3"
                                placeholder="Tambahkan penjelasan atau tujuan aspek kurikulum">
              </textarea>
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
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>