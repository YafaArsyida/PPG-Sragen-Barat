<div wire:ignore.self class="modal fade" id="ModalEditDesa" tabindex="-1" aria-labelledby="ModalEditDesaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
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
                            Edit Data Desa
                        </h5>
                        <small>
                            Perbarui informasi desa dan masjid pembina
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
                    {{-- INFORMASI UTAMA --}}
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                Informasi Utama
                            </span>
                        </div>
                        <div class="row g-4">
                            {{-- Nama Desa --}}
                            <div class="col-lg-6">
                                <label class="form-label fw-semibold">
                                    Nama Desa
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <input type="text" wire:model.defer="nama_desa" class="form-control"
                                    placeholder="Contoh : Desa Gemolong">
                                @error('nama_desa')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            {{-- Nama Masjid --}}
                            <div class="col-lg-6">
                                <label class="form-label fw-semibold">
                                    Nama Masjid
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <input type="text" wire:model.defer="nama_masjid" class="form-control"
                                    placeholder="Contoh : Masjid Al-Hikmah">
                                @error('nama_masjid')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- LOKASI --}}
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                Lokasi Desa
                            </span>
                        </div>
                        <div class="row g-4">
                            {{-- Alamat --}}
                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">
                                    Alamat
                                </label>
                                <textarea wire:model.defer="alamat" class="form-control" rows="3"
                                    placeholder="Masukkan alamat lengkap desa">
                </textarea>
                                @error('alamat')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            {{-- Google Maps --}}
                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">
                                    Tautan Google Maps
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="ri-map-pin-line text-danger">
                                        </i>
                                    </span>
                                    <input type="text" wire:model.defer="peta" class="form-control"
                                        placeholder="https://maps.google.com/...">
                                </div>
                                <div class="form-text">
                                    Tambahkan tautan lokasi Google Maps jika tersedia
                                </div>
                                @error('peta')
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
                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                Deskripsi Tambahan
                            </span>
                        </div>
                        {{-- Deskripsi --}}
                        <div>
                            <label class="form-label fw-semibold">
                                Deskripsi
                            </label>
                            <textarea wire:model.defer="deskripsi" class="form-control" rows="4"
                                placeholder="Tambahkan catatan atau informasi tambahan terkait desa">
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
                        Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>