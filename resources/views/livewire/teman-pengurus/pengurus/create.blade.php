<div wire:ignore.self class="modal fade" id="PengurusCreate" tabindex="-1" aria-labelledby="PengurusCreateLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-success-subtle text-success rounded-circle fs-20">
                            <i class="ri-team-line">
                            </i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1" id="PengurusCreateLabel">
                            Tambah Pengurus
                        </h5>
                        <small>
                            Tambahkan data pengurus baru
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
                    {{-- PENEMPATAN --}}
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                Penempatan Pengurus
                            </span>
                        </div>
                        <div class="row g-4">
                            {{-- DESA --}}
                            <div class="col-lg-3">
                                <label class="form-label fw-semibold">
                                    Desa
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <select class="form-select" wire:model="ms_desa_id">
                                    <option value="">
                                        Pilih Desa
                                    </option>
                                    @foreach($listDesa as $item)
                                    <option value="{{ $item->ms_desa_id }}">
                                        {{ $item->nama_desa }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('ms_desa_id')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            {{-- KELOMPOK --}}
                            <div class="col-lg-3">
                                <label class="form-label fw-semibold">
                                    Kelompok
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <select class="form-select" wire:model="ms_kelompok_id">
                                    <option value="">
                                        Pilih Kelompok
                                    </option>
                                    @foreach($listKelompok as $item)
                                    <option value="{{ $item->ms_kelompok_id }}">
                                        {{ $item->nama_kelompok }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('ms_kelompok_id')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- INFORMASI --}}
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                Informasi Pengurus
                            </span>
                        </div>
                        <div class="row g-4">
                            {{-- NAMA --}}
                            <div class="col-lg-6">
                                <label class="form-label fw-semibold">
                                    Nama Pengurus
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <input type="text" class="form-control" wire:model.defer="nama_pengurus"
                                    placeholder="Masukkan nama pengurus">
                                @error('nama_pengurus')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            {{-- TELEPON --}}
                            <div class="col-lg-3">
                                <label class="form-label fw-semibold">
                                    Telepon
                                </label>
                                <input type="text" class="form-control" wire:model.defer="telepon" placeholder="08xxxxxxxxxx">
                            </div>
                            {{-- KODE --}}
                            <div class="col-lg-3">
                                <label class="form-label fw-semibold">
                                    Kode Pengurus
                                </label>
                                <input type="text" class="form-control" wire:model.defer="kode_pengurus" placeholder="Contoh : PNG001">
                                @error('kode_pengurus')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- KELAHIRAN --}}
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">
                                Data Pribadi
                            </span>
                        </div>
                        <div class="row g-4">
                            {{-- TEMPAT --}}
                            <div class="col-lg-4">
                                <label class="form-label fw-semibold">
                                    Tempat Lahir
                                </label>
                                <input type="text" class="form-control" wire:model.defer="tempat_lahir">
                            </div>
                            {{-- TANGGAL --}}
                            <div class="col-lg-4">
                                <label class="form-label fw-semibold">
                                    Tanggal Lahir
                                </label>
                                <input type="date" class="form-control" wire:model.defer="tanggal_lahir">
                            </div>
                            {{-- GENDER --}}
                            <div class="col-lg-4">
                                <label class="form-label fw-semibold">
                                    Jenis Kelamin
                                </label>
                                <select class="form-select" wire:model.defer="jenis_kelamin">
                                    <option value="">
                                        Pilih Jenis Kelamin
                                    </option>
                                    <option value="laki-laki">
                                        Laki-laki
                                    </option>
                                    <option value="perempuan">
                                        Perempuan
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- TAMBAHAN --}}
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge
              bg-danger-subtle
              text-danger
              px-3
              py-2
              rounded-pill">
                                Informasi Tambahan
                            </span>
                        </div>
                        <div class="row g-4">
                            {{-- ALAMAT --}}
                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">
                                    Alamat
                                </label>
                                <textarea class="form-control" rows="3" wire:model.defer="alamat">
                </textarea>
                            </div>
                            {{-- DESKRIPSI --}}
                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">
                                    Deskripsi
                                </label>
                                <textarea class="form-control" rows="4" wire:model.defer="deskripsi">
                </textarea>
                            </div>
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
                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        <i class="ri-save-3-line me-1">
                        </i>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>