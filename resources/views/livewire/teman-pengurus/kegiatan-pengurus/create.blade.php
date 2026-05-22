<div class="modal fade" id="KegiatanCreate" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="modal-header border-0 pb-0 p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-calendar-event-line">
                            </i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">
                            Tambah Kegiatan Pengurus
                        </h5>
                        <small>
                            Tambahkan agenda kegiatan Pengurus dengan pengaturan, jadwal, dan lokasi.
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
                    <div class="row g-4">
                        {{-- ================= INFORMASI KEGIATAN ================= --}}
                        <div class="col-12">
                            <div class="border rounded-4 p-4 bg-light-subtle">
                                <div class="d-flex align-items-center gap-2 mb-4">
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                                            <i class="ri-information-line">
                                            </i>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="fw-semibold mb-0">
                                            Informasi Kegiatan
                                        </h5>
                                        <small>
                                            Atur cakupan dan identitas kegiatan Pengurus.
                                        </small>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    {{-- Nama Kegiatan --}}
                                    <div class="col-lg-12">
                                        <label class="form-label fw-semibold">
                                            Nama Kegiatan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control rounded-3"
                                            wire:model.defer="nama_kegiatan" placeholder="Masukkan nama kegiatan">
                                        @error('nama_kegiatan')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ================= TIPE KEGIATAN ================= --}}
                        <div class="col-12">
                            <div class="border rounded-4 p-4">
                                <div class="d-flex align-items-center gap-2 mb-4">
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-success-subtle text-success rounded-circle fs-20">
                                            <i class="ri-repeat-line"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="fw-semibold mb-0">
                                            Jadwal Kegiatan
                                        </h5>
                                        <small>
                                            Tentukan apakah kegiatan berlangsung sekali atau rutin.
                                        </small>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    {{-- Waktu --}}
                                    <div class="col-lg-3">
                                        <label class="form-label fw-semibold">
                                            Waktu Kegiatan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="time" step="1" class="form-control rounded-3"
                                            wire:model.defer="waktu">
                                        @error('waktu')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold">
                                            Tanggal Kegiatan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" class="form-control rounded-3" wire:model.defer="tanggal">
                                        @error('tanggal')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ================= LOKASI ================= --}}
                        <div class="col-12">
                            <div class="border rounded-4 p-4 bg-light-subtle">
                                <div class="d-flex align-items-center gap-2 mb-4">
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-warning-subtle text-warning rounded-circle fs-20">
                                            <i class="ri-map-pin-2-line"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="fw-semibold mb-0">
                                            Lokasi Kegiatan
                                        </h5>
                                        <small>
                                            Gunakan lokasi default atau tambahkan lokasi alternatif.
                                        </small>
                                    </div>
                                </div>
                                <div class="border border-2 border-dashed rounded-4 p-4 bg-white">
                                    <div class="row g-3">
                                        <div class="col-lg-6">
                                            <label class="form-label fw-semibold">
                                                Nama Tempat
                                            </label>
                                            <input type="text" class="form-control rounded-3" wire:model.defer="tempat"
                                                placeholder="Contoh: Aula Desa">
                                            @error('tempat')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label fw-semibold">
                                                Link Peta / Google Maps
                                            </label>
                                            <input type="url" class="form-control rounded-3" wire:model.defer="peta"
                                                placeholder="https://maps.google.com/...">
                                            @error('peta')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <label class="form-label fw-semibold">
                                                Alamat Lengkap
                                            </label>
                                            <input type="text" class="form-control rounded-3" wire:model.defer="alamat"
                                                placeholder="Masukkan alamat lokasi kegiatan">
                                            @error('alamat')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ================= DESKRIPSI ================= --}}
                        <div class="col-12">
                            <div class="border rounded-4 p-4">
                                <label class="form-label fw-semibold">
                                    Deskripsi Kegiatan
                                </label>
                                <textarea class="form-control rounded-3" rows="4" wire:model.defer="deskripsi"
                                    placeholder="Tambahkan catatan atau deskripsi kegiatan...">
								</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- FOOTER --}}
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i>
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="ri-save-3-line me-1"></i>
                        Simpan Kegiatan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>