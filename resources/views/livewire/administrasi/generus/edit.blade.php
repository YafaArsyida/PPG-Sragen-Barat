<div wire:ignore.self class="modal fade" id="ModalEditGenerus" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
                            Edit Data Generus
                        </h5>
                        <small>
                            Perbarui informasi generasi penerus dengan lebih rapi dan terstruktur
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
                            {{-- KELOMPOK --}}
                            <div class="col-lg-3">
                                <label class="form-label fw-semibold">
                                    Kelompok
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <select class="form-select" wire:model.defer="ms_kelompok_id">
                                    <option value="">
                                        -- Pilih Kelompok --
                                    </option>
                                    @foreach($listKelompok as $k)
                                    <option value="{{ $k->ms_kelompok_id }}">
                                        {{ $k->nama_kelompok }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('ms_kelompok_id')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            {{-- NAMA --}}
                            <div class="col-lg-5">
                                <label class="form-label fw-semibold">
                                    Nama Generus
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <input type="text" class="form-control" wire:model.defer="nama_generus"
                                    placeholder="Masukkan nama lengkap generus">
                                @error('nama_generus')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            {{-- TELEPON --}}
                            <div class="col-lg-4">
                                <label class="form-label fw-semibold">
                                    Nomor Telepon
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="ri-smartphone-line">
                                        </i>
                                    </span>
                                    <input type="text" class="form-control" wire:model.defer="nomor_telepon"
                                        placeholder="08xxxxxxxxxx">
                                </div>
                                @error('nomor_telepon')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- DATA PRIBADI --}}
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                Data Pribadi
                            </span>
                        </div>
                        <div class="row g-4">
                            {{-- TEMPAT LAHIR --}}
                            <div class="col-lg-5">
                                <label class="form-label fw-semibold">
                                    Tempat Lahir
                                </label>
                                <input type="text" class="form-control" wire:model.defer="tempat_lahir"
                                    placeholder="Contoh : Jakarta">
                                @error('tempat_lahir')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            {{-- TANGGAL LAHIR --}}
                            <div class="col-lg-3">
                                <label class="form-label fw-semibold">
                                    Tanggal Lahir
                                </label>
                                <input type="date" class="form-control" wire:model.defer="tanggal_lahir">
                                @error('tanggal_lahir')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            {{-- JENIS KELAMIN --}}
                            <div class="col-lg-4">
                                <label class="form-label fw-semibold">
                                    Jenis Kelamin
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <select class="form-select" wire:model.defer="jenis_kelamin">
                                    <option value="">
                                        -- Pilih Jenis Kelamin --
                                    </option>
                                    <option value="laki-laki">
                                        Laki-laki
                                    </option>
                                    <option value="perempuan">
                                        Perempuan
                                    </option>
                                </select>
                                @error('jenis_kelamin')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            {{-- Status Sambung --}}
                            <div class="col-lg-4">
                                <label class="form-label fw-semibold">
                                    Status Sambung
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <select class="form-select" wire:model.defer="status_generus">
                                    <option value="">
                                        -- Pilih Status Sambung --
                                    </option>
                                    <option value="sambung">
                                        Sambung
                                    </option>
                                    <option value="pindah sambung">
                                        Pindah Sambung
                                    </option>
                                    <option class="text-danger" value="nonaktif">
                                        Non-Aktif
                                    </option>
                                </select>
                                @error('status_generus')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- INFORMASI LOKASI --}}
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                Informasi Lokasi
                            </span>
                        </div>
                        <div class="row g-4">
                            {{-- ALAMAT --}}
                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">
                                    Alamat
                                </label>
                                <textarea class="form-control" rows="3" wire:model.defer="alamat"
                                    placeholder="Masukkan alamat tempat tinggal">
                </textarea>
                                @error('alamat')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- CATATAN --}}
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">
                                Catatan Tambahan
                            </span>
                        </div>
                        <div>
                            <label class="form-label fw-semibold">
                                Deskripsi
                            </label>
                            <textarea class="form-control" rows="4" wire:model.defer="deskripsi"
                                placeholder="Tambahkan catatan tambahan jika diperlukan">
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
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="ri-save-3-line me-1">
                        </i>
                        Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>