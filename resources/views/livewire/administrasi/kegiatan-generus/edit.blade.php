<div class="modal fade" id="ModalEditKegiatan" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="modal-header border-0 pb-0 p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-18">
                            <i class="ri-edit-2-line">
                            </i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">
                            Edit Kegiatan Generus
                        </h5>
                        <small>
                            Perbarui informasi kegiatan generus dengan detail yang lengkap.
                        </small>
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
                                            Atur cakupan dan identitas kegiatan generus.
                                        </small>
                                    </div>
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
                                                Pilih Tingkat
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
                                            Penempatan Kelompok
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        <select class="form-select rounded-3" wire:model="ms_kelompok_id">
                                            <option value="">
                                                Pilih Kelompok
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
                                            Jenjang Peserta
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
                                            {{--
                                            <option value="pra_nikah">
                                                Pra Nikah
                                            </option>
                                            --}}
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
                                        <input type="text" class="form-control rounded-3" wire:model.defer="nama_kegiatan"
                                            placeholder="Masukkan nama kegiatan">
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
                                            <i class="ri-repeat-line">
                                            </i>
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
                                    {{-- Tipe Kegiatan --}}
                                    <div class="col-lg-12">
                                        <label class="form-label fw-semibold">
                                            Tipe Kegiatan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="row g-3">
                                            <div class="col-lg-4">
                                                <label
                                                    class="border rounded-4 p-4 w-100 cursor-pointer bg-light-subtle">
                                                    <div class="d-flex align-items-start gap-3">
                                                        <input type="radio" wire:model="tipe_kegiatan" value="sekali" class="form-check-input mt-1">
                                                        <div>
                                                            <h5 class="fw-semibold mb-1">
                                                                Kegiatan Sekali
                                                            </h5>
                                                            <small>Digunakan untuk event atau kegiatan pada tanggal tertentu.</small>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-lg-4">
                                                <label
                                                    class="border rounded-4 p-4 w-100 cursor-pointer bg-light-subtle">
                                                    <div class="d-flex align-items-start gap-3">
                                                        <input type="radio" wire:model="tipe_kegiatan" value="rutin" class="form-check-input mt-1">
                                                        <div>
                                                            <h5 class="fw-semibold mb-1">
                                                                Kegiatan Rutin
                                                            </h5>
                                                            <small>Digunakan untuk kegiatan mingguan yang berulang.</small>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="border rounded-4 p-4 w-100 cursor-pointer bg-light-subtle">
                                                    <div class="d-flex align-items-start gap-3">
                                                        <input type="radio" wire:model="tipe_kegiatan" value="khusus" class="form-check-input mt-1">
                                                        <div>
                                                            <h5 class="fw-semibold mb-1">
                                                                Kegiatan Khusus
                                                            </h5>
                                                            <small>Digunakan untuk kegiatan tertentu yang tidak berulang.</small>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        @error('tipe_kegiatan')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    {{-- Waktu --}}
                                    @if(in_array($tipe_kegiatan, ['sekali', 'rutin']))
                                    <div class="col-lg-3">
                                        <label class="form-label fw-semibold">
                                            Waktu Kegiatan
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="time" step="1" class="form-control rounded-3" wire:model.defer="waktu">

                                        @error('waktu')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    @endif
                                    {{-- EVENT/sekali --}} 
                                    @if($tipe_kegiatan === 'sekali')
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
                                    @endif 
                                    {{-- Hari Rutin --}} 
                                    @if($tipe_kegiatan === 'rutin')
                                        <div class="col-lg-9">
                                            <label class="form-label fw-semibold">
                                                Hari Rutin
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="row g-3">
                                                @foreach($listHari as $key => $label)
                                                <div class="col-6 col-md-3">
                                                    <label class="border rounded-3 p-3 w-100 cursor-pointer bg-light-subtle">
                                                        <div class="form-check mb-0">
                                                            <input class="form-check-input" type="checkbox" wire:model="hari_rutin" value="{{ $key }}" id="hari_{{ $key }}">
                                                            <label class="form-check-label fw-medium" for="hari_{{ $key }}">
                                                                {{ $label }}
                                                            </label>
                                                        </div>
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                            @error('hari_rutin')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="alert alert-info border-0 rounded-4 mb-0">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                                                            <i class="ri-information-line"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h5 class="fw-semibold mb-0">
                                                            Informasi Kegiatan Rutin
                                                        </h5>
                                                        <small>
                                                            Lokasi kegiatan dapat disesuaikan kembali saat presensi apabila terjadi perpindahan tempat.
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($tipe_kegiatan === 'khusus')
                                        <div class="col-12">
                                            <div class="alert alert-warning border-0 rounded-4 mb-0">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title bg-warning-subtle text-warning rounded-circle fs-20">
                                                            <i class="ri-calendar-event-line"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h5 class="fw-semibold mb-0">
                                                            Informasi Kegiatan Khusus
                                                        </h5>
                                                        <small>
                                                            Satu kegiatan dapat memiliki beberapa tanggal pelaksanaan dengan waktu yang berbeda-beda.
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label fw-semibold mb-0">
                                                    Jadwal Kegiatan
                                                    <span class="text-danger">*</span>
                                                </label>
{{-- 
                                                <button type="button" class="btn btn-soft-primary btn-sm" wire:click="addJadwalKhusus">

                                                    <i class="ri-add-line"></i>
                                                    Tambah Jadwal
                                                </button> --}}
                                            </div>

                                            @foreach($jadwal_khusus as $index => $jadwal)
                                            <div class="card border shadow-none mb-3">
                                                <div class="card-body">

                                                    <div class="row g-3">

                                                        <div class="col-md-5">
                                                            <label class="form-label">
                                                                Jadwal #{{ $index + 1 }}
                                                            </label>

                                                            <input type="date" class="form-control" wire:model="jadwal_khusus.{{ $index }}.tanggal">

                                                            @error('jadwal_khusus.'.$index.'.tanggal')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-5">
                                                            <label class="form-label">
                                                                Waktu
                                                            </label>

                                                            <input type="time" step="1" class="form-control" wire:model="jadwal_khusus.{{ $index }}.waktu">
                                                            @error('jadwal_khusus.'.$index.'.waktu')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-2 d-flex align-items-end">
                                                            <button type="button" class="btn btn-soft-danger w-100" wire:click="removeJadwalKhusus({{ $index }})">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="mt-2">
                                                <button type="button" class="btn btn-soft-primary rounded-pill px-4" wire:click="addJadwalKhusus">
                                                    <i class="ri-add-line me-1">
                                                    </i>
                                                    Tambah Jadwal
                                                </button>
                                            </div>

                                            @error('jadwal_khusus')
                                                <small class="text-danger d-block">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- ================= LOKASI ================= --}}
                        <div class="col-12">
                            <div class="border rounded-4 p-4 bg-light-subtle">
                                <div class="d-flex align-items-center gap-2 mb-4">
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-warning-subtle text-warning rounded-circle fs-20">
                                            <i class="ri-map-pin-2-line">
                                            </i>
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
                                {{-- Lokasi Default --}} @if($scope && $lokasi_default)
                                <div class="border rounded-4 p-4 bg-white mb-4">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="avatar-sm flex-shrink-0">
                                            <div class="avatar-title bg-success-subtle text-success rounded-circle fs-20">
                                                <i class="ri-building-line">
                                                </i>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="fw-semibold mb-1">
                                                {{ $lokasi_default['tempat'] ?? '-' }}
                                            </h5>
                                            <p class="text-muted fs-13 mb-2">
                                                {{ $lokasi_default['alamat'] ?? '-' }}
                                            </p>
                                            @if(!empty($lokasi_default['peta']))
                                            <a href="{{ $lokasi_default['peta'] }}" target="_blank"
                                                class="btn btn-sm btn-soft-primary rounded-pill">
                                                <i class="ri-map-pin-line me-1">
                                                </i>
                                                Lihat Peta
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif {{-- Toggle --}}
                                <div class="form-check form-switch form-switch-md mb-4">
                                    <input class="form-check-input" type="checkbox" wire:model="use_custom_lokasi"
                                        id="useCustomLokasi">
                                    <h5 class="form-check-label fw-semibold" for="useCustomLokasi">
                                        Gunakan lokasi alternatif
                                    </h5>
                                    <div>
                                        Aktifkan jika kegiatan tidak dilakukan di lokasi diatas.
                                    </div>
                                </div>
                                {{-- Custom Lokasi --}} @if($use_custom_lokasi)
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
                                @endif
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