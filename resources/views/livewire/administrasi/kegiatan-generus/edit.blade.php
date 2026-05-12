<div class="modal fade" id="ModalEditKegiatan" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="modal-header bg-light border-0 px-4 py-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-warning-subtle text-warning rounded-circle fs-18">
                            <i class="ri-edit-2-line">
                            </i>
                        </div>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold mb-1">
                            Edit Kegiatan Generus
                        </h5>
                        <p class="text-muted fs-13 mb-0">
                            Perbarui informasi kegiatan generus dengan detail yang lengkap.
                        </p>
                    </div>
                </div>
                <button type="button" class="btn btn-light btn-icon rounded-circle shadow-none" data-bs-dismiss="modal">
                    <i class="ri-close-line fs-18">
                    </i>
                </button>
            </div>
            <form wire:submit.prevent="update">
                <div class="modal-body p-4">
                    <div class="row g-4">
                        {{-- INFORMASI KEGIATAN --}}
                        <div class="col-12">
                            <div class="border rounded-4 p-4 bg-light-subtle">
                                <div class="d-flex align-items-center gap-2 mb-4">
                                    <div class="avatar-xs">
                                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                            <i class="ri-information-line">
                                            </i>
                                        </div>
                                    </div>
                                    <h6 class="fw-bold mb-0">
                                        Informasi Kegiatan
                                    </h6>
                                </div>
                                <div class="row g-3">
                                    {{-- Scope --}}
                                    <div class="col-lg-3">
                                        <label class="form-label fw-semibold">
                                            Tingkat Kegiatan
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        <select class="form-select rounded-3" wire:model="scope">
                                            <option value="">
                                                -- Pilih Tingkat --
                                            </option>
                                            <option value="daerah">
                                                Daerah
                                            </option>
                                            <option value="desa">
                                                Desa
                                            </option>
                                            <option value="kelompok">
                                                Kelompok
                                            </option>
                                        </select>
                                        @error('scope')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    {{-- Kelompok --}} @if($scope === 'kelompok')
                                    <div class="col-lg-5">
                                        <label class="form-label fw-semibold">
                                            Kelompok
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        <select class="form-select rounded-3" wire:model="ms_kelompok_id">
                                            <option value="">
                                                -- Pilih Kelompok --
                                            </option>
                                            @foreach($listKelompok as $k)
                                            <option value="{{ $k->ms_kelompok_id }}">
                                                {{ $k->nama_kelompok }} @if($k->ms_desa) - {{ $k->ms_desa->nama_desa }}
                                                @endif
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('ms_kelompok_id')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    @endif {{-- Jenjang --}}
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold">
                                            Jenjang Generus
                                        </label>
                                        <select class="form-select rounded-3" wire:model.defer="jenjang">
                                            <option value="semua">
                                                Semua Jenjang
                                            </option>
                                            <option value="caberawit">
                                                Caberawit
                                            </option>
                                            <option value="remaja">
                                                Remaja
                                            </option>
                                            <option value="gp">
                                                GP
                                            </option>
                                            <option value="pra_nikah">
                                                Pra Nikah
                                            </option>
                                            <option value="mandiri">
                                                Mandiri
                                            </option>
                                        </select>
                                        @error('jenjang')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    {{-- Nama Kegiatan --}}
                                    <div class="col-lg-12">
                                        <label class="form-label fw-semibold">
                                            Nama Kegiatan
                                            <span class="text-danger">
                                                *
                                            </span>
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
                        {{-- TIPE KEGIATAN --}}
                        <div class="col-12">
                            <div class="border rounded-4 p-4">
                                <div class="d-flex align-items-center gap-2 mb-4">
                                    <div class="avatar-xs">
                                        <div class="avatar-title bg-success-subtle text-success rounded-circle">
                                            <i class="ri-repeat-line">
                                            </i>
                                        </div>
                                    </div>
                                    <h6 class="fw-bold mb-0">
                                        Tipe Pelaksanaan
                                    </h6>
                                </div>
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <label class="border rounded-4 p-4 d-block h-100 cursor-pointer transition">
                                            <div class="d-flex align-items-start gap-3">
                                                <input type="radio" wire:model="tipe_kegiatan" value="sekali"
                                                    class="form-check-input mt-1">
                                                <div>
                                                    <h6 class="fw-bold mb-1">
                                                        Kegiatan Sekali
                                                    </h6>
                                                    <p class="text-muted fs-13 mb-0">
                                                        Kegiatan hanya dilakukan satu kali pada tanggal tertentu.
                                                    </p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="border rounded-4 p-4 d-block h-100 cursor-pointer transition">
                                            <div class="d-flex align-items-start gap-3">
                                                <input type="radio" wire:model="tipe_kegiatan" value="rutin"
                                                    class="form-check-input mt-1">
                                                <div>
                                                    <h6 class="fw-bold mb-1">
                                                        Kegiatan Rutin
                                                    </h6>
                                                    <p class="text-muted fs-13 mb-0">
                                                        Kegiatan dilakukan secara rutin pada hari tertentu setiap
                                                        minggu.
                                                    </p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                @error('tipe_kegiatan')
                                <small class="text-danger d-block mt-2">
                                    {{ $message }}
                                </small>
                                @enderror @if($tipe_kegiatan === 'rutin')
                                <div class="alert alert-info border-0 rounded-4 mt-4 mb-0">
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="ri-information-line fs-20">
                                        </i>
                                        <div>
                                            <h6 class="fw-semibold mb-1">
                                                Informasi Kegiatan Rutin
                                            </h6>
                                            <p class="mb-0 fs-13">
                                                Lokasi kegiatan rutin dapat dikonfirmasi ulang saat presensi apabila
                                                terjadi
                                                rotasi tempat kegiatan.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        {{-- JADWAL --}}
                        <div class="col-12">
                            <div class="border rounded-4 p-4">
                                <div class="d-flex align-items-center gap-2 mb-4">
                                    <div class="avatar-xs">
                                        <div class="avatar-title bg-warning-subtle text-warning rounded-circle">
                                            <i class="ri-calendar-check-line">
                                            </i>
                                        </div>
                                    </div>
                                    <h6 class="fw-bold mb-0">
                                        Jadwal Pelaksanaan
                                    </h6>
                                </div>
                                <div class="row g-3">
                                    {{-- Waktu --}}
                                    <div class="col-lg-3">
                                        <label class="form-label fw-semibold">
                                            Waktu
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        <input type="time" step="1" class="form-control rounded-3"
                                            wire:model.defer="waktu">
                                        @error('waktu')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    {{-- Tanggal --}} @if($tipe_kegiatan === 'sekali')
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold">
                                            Tanggal
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        <input type="date" class="form-control rounded-3" wire:model.defer="tanggal">
                                        @error('tanggal')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    @endif {{-- Hari Rutin --}} @if($tipe_kegiatan === 'rutin')
                                    <div class="col-lg-9">
                                        <label class="form-label fw-semibold">
                                            Hari Rutin
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        <div class="row g-3">
                                            @foreach($listHari as $key => $label)
                                            <div class="col-md-3 col-6">
                                                <label
                                                    class="border rounded-3 p-3 d-flex align-items-center gap-2 cursor-pointer h-100">
                                                    <input class="form-check-input" type="checkbox"
                                                        wire:model="hari_rutin" value="{{ $key }}">
                                                    <span class="fw-medium">
                                                        {{ $label }}
                                                    </span>
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                        @error('hari_rutin')
                                        <small class="text-danger d-block mt-2">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- LOKASI --}}
                        <div class="col-12">
                            <div class="border rounded-4 p-4">
                                <div class="d-flex align-items-center gap-2 mb-4">
                                    <div class="avatar-xs">
                                        <div class="avatar-title bg-danger-subtle text-danger rounded-circle">
                                            <i class="ri-map-pin-line">
                                            </i>
                                        </div>
                                    </div>
                                    <h6 class="fw-bold mb-0">
                                        Lokasi Kegiatan
                                    </h6>
                                </div>
                                {{-- Lokasi Default --}} @if($scope && $lokasi_default)
                                <div class="border rounded-4 bg-light p-4 mb-4">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="avatar-sm">
                                            <div class="avatar-title bg-success-subtle text-success rounded-circle">
                                                <i class="ri-map-pin-2-line">
                                                </i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="fw-semibold mb-1">
                                                Lokasi Default
                                            </h6>
                                            <p class="text-muted mb-1">
                                                <strong>
                                                    {{ $lokasi_default['tempat'] ?? '-' }}
                                                </strong>
                                            </p>
                                            <p class="text-muted fs-13 mb-0">
                                                {{ $lokasi_default['alamat'] ?? '-' }}
                                            </p>
                                            @if(!empty($lokasi_default['peta']))
                                            <a href="{{ $lokasi_default['peta'] }}" target="_blank"
                                                class="btn btn-sm btn-soft-primary rounded-pill mt-3">
                                                <i class="ri-map-2-line me-1">
                                                </i>
                                                Lihat Peta
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif {{-- Toggle --}}
                                <div class="form-check form-switch form-switch-lg">
                                    <input class="form-check-input" type="checkbox" wire:model="use_custom_lokasi"
                                        id="useCustomLokasi">
                                    <label class="form-check-label fw-semibold" for="useCustomLokasi">
                                        Gunakan lokasi alternatif
                                    </label>
                                    <div class="text-muted fs-13 mt-1">
                                        Aktifkan jika kegiatan dilaksanakan di luar lokasi default.
                                    </div>
                                </div>
                                {{-- Custom Lokasi --}} @if($use_custom_lokasi)
                                <div class="row g-3 mt-3">
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold">
                                            Tempat
                                        </label>
                                        <input type="text" class="form-control rounded-3" wire:model.defer="tempat"
                                            placeholder="Nama tempat kegiatan">
                                        @error('tempat')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold">
                                            URL Peta
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
                                            placeholder="Masukkan alamat lengkap">
                                        @error('alamat')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        {{-- DESKRIPSI --}}
                        <div class="col-12">
                            <div class="border rounded-4 p-4">
                                <div class="d-flex align-items-center gap-2 mb-4">
                                    <div class="avatar-xs">
                                        <div class="avatar-title bg-info-subtle text-info rounded-circle">
                                            <i class="ri-file-text-line">
                                            </i>
                                        </div>
                                    </div>
                                    <h6 class="fw-bold mb-0">
                                        Catatan Tambahan
                                    </h6>
                                </div>
                                <textarea class="form-control rounded-3" rows="4" wire:model.defer="deskripsi"
                                    placeholder="Tambahkan deskripsi atau catatan kegiatan (opsional)">
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
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="ri-save-3-line me-1">
                        </i>
                        Perbarui Kegiatan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>