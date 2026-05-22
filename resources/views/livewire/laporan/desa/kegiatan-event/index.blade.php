<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    {{-- HEADER --}}
    <div class="card-header bg-white border-0 p-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            {{-- TITLE --}}
            <div>
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-file-chart-line"></i>
                        </div>
                    </div>
                    
                    <div>
                        <h5 class="fw-bold mb-1">
                            Laporan Kegiatan Generus
                        </h5>
                        <small>
                            Monitoring kehadiran dan aktivitas kegiatan generasi penerus
                        </small>
                    </div>
                </div>
            </div>
            {{-- ACTION --}}
            <div class="d-flex flex-wrap gap-2">
                <button data-bs-toggle="modal" data-bs-target="#ExportLaporanExcel"
                    class="btn btn-soft-success rounded-pill px-3">
                    <i class="ri-file-excel-2-line me-1">
                    </i>
                    Export Excel
                </button>
            </div>
        </div>
    </div>
    {{-- FILTER --}}
    <div class="card-body border-top border-bottom bg-light-subtle">
        <div class="row g-3 align-items-end">
            {{-- SEARCH --}}
            <div class="col-12 col-lg-6 col-xxl-4">
                <label class="form-label fw-semibold">
                    Cari Kegiatan
                </label>
                <div class="search-box">
                    <input type="text" class="form-control search" placeholder="Cari nama kegiatan..."
                        wire:model.debounce.500ms="search">
                    <i class="ri-search-line search-icon">
                    </i>
                </div>
            </div>
            {{-- JENJANG --}}
            <div class="col-6 col-md-4 col-lg-3 col-xxl-2">
                <label class="form-label fw-semibold">
                    Jenjang
                </label>
                <select class="form-select rounded-3" wire:model="jenjangUsia">
                    <option value="">
                        Semua Generus
                    </option>
                    <option value="caberawit">
                        Caberawit (0–11)
                    </option>
                    <option value="remaja">
                        Remaja (12–30)
                    </option>
                    <option value="gp">
                        GP (12–23)
                    </option>
                    <option value="pra_nikah">
                        Pra Nikah (19–23)
                    </option>
                    <option value="mandiri">
                        Mandiri (23–25)
                    </option>
                </select>
            </div>
            {{-- STATUS --}}
            <div class="col-6 col-md-4 col-lg-3 col-xxl-2">
                <label class="form-label fw-semibold">
                    Status
                </label>
                <select class="form-select rounded-3" wire:model="status">
                    <option value="">
                        Semua
                    </option>
                    <option value="aktif">
                        Aktif
                    </option>
                    <option value="selesai">
                        Selesai
                    </option>
                </select>
            </div>
            {{-- PERIODE --}}
            <div class="col-12 col-xl-8 col-xxl-4">
                <label class="form-label fw-semibold">
                    Periode
                </label>
                <div class="d-flex align-items-center gap-2">
                    <input type="date" class="form-control rounded-3" wire:model="startDate" value="{{ $startDate }}">
                    <div class="text-muted flex-shrink-0">
                        —
                    </div>
                    <input type="date" class="form-control rounded-3" wire:model="endDate" value="{{ $endDate }}">
                    <button type="button" class="btn btn-soft-secondary btn-icon rounded-circle flex-shrink-0"
                        wire:click="resetTanggal" title="Reset Tanggal">
                        <i class="ri-refresh-line">
                        </i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- TABLE --}}
    <div class="card-body pt-3">
        <div class="table-responsive">
            <table id="Laporan" class="table table-hover align-middle table-nowrap mb-0">
                <thead class="table-light">
                    <tr class="text-uppercase fs-12">
                        <th width="60" class="ps-4">#</th>
                        <th>Tanggal</th>
                        <th>Kegiatan</th>
                        <th>Peserta</th>
                        <th>Tingkat</th>
                        <th class="text-center">Target</th>
                        <th class="text-center text-primary">Hadir</th>
                        <th class="text-center">Izin</th>
                        <th class="text-center text-danger">Alfa</th>
                        <th class="text-center text-primary">% Hadir</th>
                        <th class="text-center">% Izin</th>
                        <th class="text-center text-danger">% Alfa</th>
                        <th class="text-center">Infaq</th>
                        <th class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $item)
                    <tr>
                        {{-- NO --}}
                        <td class="ps-4 fw-semibold text-muted">
                            {{ $data->firstItem() + $index }}
                        </td>
                        {{-- TANGGAL --}}
                        <td>
                            <div class="fw-semibold text-body">
                                {{ $item->tanggal ?
                                \App\Http\Controllers\HelperController::formatTanggalIndonesia($item->tanggal,
                                'd F Y') : '-' }}
                            </div>
                            <div class="fs-12 text-muted">
                                <i class="ri-time-line me-1">
                                </i>
                                {{ $item->waktu }}
                            </div>
                        </td>
                        {{-- KEGIATAN --}}
                        <td>
                            <div class="fw-semibold text-dark">
                                {{ $item->nama_kegiatan }}
                            </div>
                            <div class="fs-12 text-muted mt-1">
                                @if($item->scope === 'daerah')
                                <span class="badge bg-primary-subtle text-primary rounded-pill">
                                    Daerah
                                </span>
                                @elseif($item->scope === 'desa')
                                <span class="badge bg-success-subtle text-success rounded-pill">
                                    Desa
                                </span>
                                @elseif($item->scope === 'kelompok')
                                <span class="badge bg-warning-subtle text-warning rounded-pill">
                                    Kelompok
                                </span>
                                @endif
                            </div>
                        </td>
                        {{-- PESERTA --}}
                        <td>
                            @php 
                            if ($item->jenjang) { [$jenjangLabel, $jenjangClass] = match($item->jenjang)
                                { 
                                    'caberawit' => ['Caberawit', 'text-info'], 
                                    'remaja' => ['Remaja', 'text-primary'], 
                                    'gp' => ['GP', 'text-success'], 
                                    'mandiri' => ['Mandiri', 'text-danger'],

                                    default => ['-', 'text-muted'], 
                                }; 
                            } else 
                                { 
                                    [$jenjangLabel, $jenjangClass] = ['Semua Jenjang', 'text-muted']; 
                                } 
                            @endphp
                            <div class="{{ $jenjangClass }}">
                                {{ $jenjangLabel }}
                            </div>
                        </td>
                        {{-- TINGKAT --}}
                        <td>
                            <div class="fw-medium">
                                @if($item->scope === 'daerah') Daerah Solo Selatan @elseif($item->scope
                                === 'desa') Desa {{ $item->ms_desa->nama_desa ?? '-' }} @elseif($item->scope
                                === 'kelompok') Kelompok {{ $item->ms_kelompok->nama_kelompok ?? '-' }}
                                @endif
                            </div>
                        </td>
                        {{-- TARGET --}}
                        <td class="text-center fw-bold">
                            {{ $item->targetPeserta() }}
                        </td>
                        {{-- HADIR --}}
                        <td class="text-center">
                            <div class="fw-bold text-primary">
                                {{ $item->totalHadir() }}
                            </div>
                        </td>
                        {{-- IZIN --}}
                        <td class="text-center">
                            <div class="fw-bold text-secondary">
                                {{ $item->totalIzin() }}
                            </div>
                        </td>
                        {{-- ALFA --}}
                        <td class="text-center">
                            <div class="fw-bold text-danger">
                                {{ $item->totalAlfa() }}
                            </div>
                        </td>
                        {{-- % HADIR --}}
                        <td class="text-center text-primary">
                            {{ $item->presentaseHadir() }}%
                        </td>
                        {{-- % IZIN --}}
                        <td class="text-center text-secondary">
                            {{ $item->presentaseIzin() }}%
                        </td>
                        {{-- % ALFA --}}
                        <td class="text-center text-danger">
                            {{ $item->presentaseAlfa() }}%
                        </td>
                        <td class="text-center">
                            @php 
                                $totalInfaq = $item->tr_infaq_sum_nominal ?? 0; 
                            @endphp 
                            @if($totalInfaq > 0) 
                            {{-- SUDAH ADA INFAQ --}}
                            <a href="#ModalInfaqEdit" data-bs-toggle="modal"
                                wire:click.prevent="$emit('InfaqEdit', {{ $item->ms_kegiatan_id }})"
                                class="btn btn-primary rounded-pill px-3">
                                <i class="ri-money-dollar-circle-line me-1">
                                </i>
                                Rp {{ number_format($totalInfaq, 0, ',', '.') }}
                            </a>
                            @else 
                            {{-- BELUM ADA --}}
                            <a href="#ModalInfaqCreate" data-bs-toggle="modal"
                                wire:click.prevent="$emit('InfaqCreate', {{ $item->ms_kegiatan_id }})"
                                class="btn btn-soft-primary rounded-pill px-3">
                                <i class="ri-hand-coin-line me-1">
                                </i>
                                Rp 0
                            </a>
                            @endif
                        </td>
                        {{-- ACTION --}}
                        <td class="text-center pe-4">
                            <div class="d-flex justify-content-center gap-2">
                                {{-- DETAIL --}}
                                <a href="#ModalDetailKegiatan" data-bs-toggle="modal" class="btn btn-soft-primary btn-sm rounded-pill px-3"
                                    title="Detail Kegiatan" wire:click.prevent="$emit('KegiatanDetail', {{ $item->ms_kegiatan_id }})">
                                    <i class="ri-eye-line me-1"></i>
                                    Detail
                                </a>
                                {{-- REPORT --}}
                                <a href="javascript:void(0)" data-bs-toggle="offcanvas" class="btn btn-primary btn-sm rounded-pill px-3"
                                    data-bs-target="#offcanvasLaporan" aria-controls="offcanvasLaporan"
                                    title="Laporan Kegiatan" wire:click.prevent="$emit('KegiatanReport', {{ $item->ms_kegiatan_id }}, {{ $ms_desa_id }})">
                                    <i class="ri-file-chart-line"></i>
                                    Laporan
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="14" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-md mb-3">
                                    <div class="avatar-title bg-light text-muted rounded-circle fs-2">
                                        <i class="ri-inbox-2-line">
                                        </i>
                                    </div>
                                </div>
                                <h6 class="fw-semibold mb-1">
                                    Belum Ada Laporan
                                </h6>
                                <p class="text-muted mb-0 fs-13">
                                    Data kegiatan generus belum tersedia.
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- PAGINATION --}}
        <div class="mt-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="text-muted fs-13">
                    Menampilkan
                    <span class="fw-semibold">
                        {{ $data->firstItem() ?? 0 }}
                    </span>
                    -
                    <span class="fw-semibold">
                        {{ $data->lastItem() ?? 0 }}
                    </span>
                    dari
                    <span class="fw-semibold">
                        {{ $data->total() }}
                    </span>
                    data Kegiatan
                </div>
                <div>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>