<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    {{-- HEADER --}}
    <div class="card-header bg-white border-0 p-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            {{-- TITLE --}}
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-3 fs-20">
                            <i class="ri-file-chart-line"></i>
                        </div>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">
                            Laporan Kegiatan Rutin Generus
                        </h4>
                        <p class="text-muted mb-0 fs-13">
                            Monitoring kehadiran dan aktivitas kegiatan generasi penerus
                        </p>
                    </div>
                </div>
            </div>
            {{-- ACTION --}}
            <div class="d-flex flex-wrap gap-2">
                <button data-bs-toggle="modal" data-bs-target="#ExportLaporanExcel"
                    class="btn btn-soft-success rounded-pill px-3">
                    <i class="ri-file-excel-2-line me-1"></i>
                    Export Excel
                </button>
            </div>
        </div>
    </div>
    {{-- FILTER --}}
    <div class="card-body border-top border-bottom bg-light-subtle flex-grow-0">
        <div class="row g-3 align-items-end">
            {{-- SEARCH --}}
            <div class="col-xxl-4 col-lg-4">
                <label class="form-label fw-semibold">
                    Pencarian
                </label>
                <div class="search-box">
                    <input type="text" class="form-control border-light shadow-sm rounded-3"
                        placeholder="Cari nama kegiatan..." wire:model.debounce.500ms="search">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
            {{-- KELOMPOK --}}
            <div class="col-xxl-2 col-lg-4 col-sm-6">
                <label class="form-label fw-semibold">
                    Kelompok
                </label>
                <select class="form-select rounded-3 border-light shadow-sm" wire:model="ms_kelompok_id" wire:loading.attr="disabled">
                    @foreach($listKelompok as $k)
                    <option value="{{ $k->ms_kelompok_id }}">
                        Kelompok {{ $k->nama_kelompok }}
                    </option>
                    @endforeach
                </select>
            </div>
            {{-- JENJANG --}}
            <div class="col-xxl-2 col-lg-4 col-sm-6">
                <label class="form-label fw-semibold">
                    Jenjang Usia
                </label>
                <select class="form-select rounded-3 border-light shadow-sm" wire:model="jenjangUsia">
                    <option value="">Semua Generus</option>
                    <option value="caberawit">Caberawit (0–11)</option>
                    <option value="remaja">Remaja (12–30)</option>
                    <option value="gp">GP (12–23)</option>
                    <option value="pra_nikah">Pra Nikah (19–23)</option>
                    <option value="mandiri">Mandiri (23–25)</option>
                </select>
            </div>
            {{-- STATUS --}}
            <div class="col-xxl-2 col-lg-6 col-sm-6">
                <label class="form-label fw-semibold">
                    Status
                </label>
                <select class="form-select rounded-3 border-light shadow-sm" wire:model="status">
                    <option value="">Semua</option>
                    <option value="aktif">Aktif</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>
            {{-- HARI --}}
            <div class="col-xxl-2 col-lg-6 col-sm-6">
                <label class="form-label fw-semibold">
                    Hari
                </label>
                <select class="form-select rounded-3 border-light shadow-sm" wire:model="hari">
                    <option value="">Semua Hari</option>
                    <option value="senin">Senin</option>
                    <option value="selasa">Selasa</option>
                    <option value="rabu">Rabu</option>
                    <option value="kamis">Kamis</option>
                    <option value="jumat">Jumat</option>
                    <option value="sabtu">Sabtu</option>
                    <option value="minggu">Minggu</option>
                </select>
            </div>
        </div>
    </div>
    {{-- TABLE --}}
    <div class="card-body pt-3">
        <div class="table-responsive">
            <table id="Laporan" class="table table-hover align-middle mb-0">
                <thead class="bg-light-subtle">
                    <tr class="text-uppercase fs-12">
                        <th style="width: 60px">#</th>
                        <th>Jadwal Rutin</th>
                        <th>Waktu</th>
                        <th>Kegiatan</th>
                        <th>Peserta</th>
                        <th>Tingkat</th>
                        <th>Target</th>
                        <th class="text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $item)
                    <tr>
                        {{-- NO --}}
                        <td class="text-muted fw-semibold">
                            {{ $data->firstItem() + $index }}
                        </td>
                        {{-- HARI --}}
                        <td>
                            @if($item->hari_rutin && count($item->hari_rutin))
                            <div class="d-flex flex-wrap gap-1">
                                @foreach($item->hari_rutin as $hari)
                                <span class="badge bg-soft-primary text-primary rounded-pill px-2 py-1">
                                    {{ ucfirst($hari) }}
                                </span>
                                @endforeach
                            </div>
                            @else
                            <span class="text-muted">
                                Jadwal Mingguan
                            </span>
                            @endif
                        </td>
                        {{-- WAKTU --}}
                        <td>
                            <span class="badge bg-light text-body rounded-pill px-3 py-2 fw-medium">
                                <i class="ri-time-line me-1">
                                </i>
                                {{ $item->waktu }}
                            </span>
                        </td>
                        {{-- KEGIATAN --}}
                        <td>
                            <div class="fw-semibold text-body">
                                {{ $item->nama_kegiatan }}
                            </div>
                            @if($item->deskripsi)
                            <small class="text-muted">
                                {{ Str::limit($item->deskripsi, 60) }}
                            </small>
                            @endif
                        </td>
                        {{-- PESERTA --}}
                        <td>
                            @php if ($item->jenjang) { [$jenjangLabel, $jenjangClass] = match($item->jenjang)
                            { 'caberawit' => ['Caberawit', 'text-warning'], 'remaja' => ['Remaja',
                            'text-primary'], 'gp' => ['GP', 'text-success'], 'mandiri' => ['Mandiri',
                            'text-danger'], default => ['-', 'text-muted'], }; } else { [$jenjangLabel,
                            $jenjangClass] = ['Semua Jenjang', 'text-muted']; } if ($item->scope ===
                            'kelompok' && $item->ms_kelompok) { $lokasiLabel = "Kelompok
                            ".$item->ms_kelompok->nama_kelompok;
                            } elseif ($item->scope === 'desa' && $item->ms_desa) { $lokasiLabel = "Desa
                            ".$item->ms_desa->nama_desa; } elseif ($item->scope === 'daerah') { $lokasiLabel
                            = "Daerah Solo Selatan"; } else { $lokasiLabel = '-'; } @endphp
                            <div class="fw-semibold {{ $jenjangClass }}">
                                {{ $jenjangLabel }}
                            </div>
                            <small class="text-muted">
                                {{ $lokasiLabel }}
                            </small>
                        </td>
                        {{-- TINGKAT --}}
                        <td>
                            @if($item->scope === 'daerah')
                            <span class="badge bg-soft-primary text-primary rounded-pill px-3 py-2">
                                Kegiatan Daerah
                            </span>
                            @elseif($item->scope === 'desa')
                            <span class="badge bg-soft-success text-success rounded-pill px-3 py-2">
                                Kegiatan Desa
                            </span>
                            @elseif($item->scope === 'kelompok')
                            <span class="badge bg-soft-warning text-warning rounded-pill px-3 py-2">
                                Kegiatan Kelompok
                            </span>
                            @endif
                        </td>
                        {{-- TARGET --}}
                        <td>
                            <div class="fw-semibold">
                                {{ $item->targetPeserta() }}
                            </div>
                            <small class="text-muted">
                                Peserta
                            </small>
                        </td>
                        {{-- AKSI --}}
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                {{-- DETAIL --}}
                                <a href="#ModalDetailKegiatan" data-bs-toggle="modal"
                                    class="btn btn-sm btn-light rounded-pill" title="Detail Kegiatan"
                                    wire:click.prevent="$emit('KegiatanDetail', {{ $item->ms_kegiatan_id }})">
                                    <i class="ri-eye-line me-1">
                                    </i>
                                    Detail
                                </a>
                                {{-- LAPORAN --}}
                                <a href="javascript:void(0)" class="btn btn-sm btn-soft-success rounded-pill"
                                    title="Laporan Kehadiran" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasLaporan" aria-controls="offcanvasLaporan"
                                    wire:click.prevent="$emit('KegiatanReport', {{ $item->ms_kegiatan_id }}, {{ $ms_kelompok_id }})">
                                    <i class="ri-file-chart-line me-1">
                                    </i>
                                    Laporan
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty {{-- EMPTY --}}
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-md mb-3">
                                    <div class="avatar-title bg-light text-muted rounded-circle fs-24">
                                        <i class="ri-inbox-archive-line">
                                        </i>
                                    </div>
                                </div>
                                <h6 class="fw-semibold mb-1">
                                    Belum Ada Data Kegiatan
                                </h6>
                                <p class="text-muted mb-0 fs-13">
                                    Data kegiatan rutin belum tersedia.
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- PAGINATION --}} @if($data->hasPages())
    <div class="card-footer bg-white border-0 pt-3">
        {{ $data->links() }}
    </div>
    @endif
</div>