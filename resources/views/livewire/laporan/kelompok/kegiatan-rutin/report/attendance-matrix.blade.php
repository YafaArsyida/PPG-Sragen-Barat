<div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
    {{-- HEADER --}}
    <div class="card-header bg-white border-0 p-4">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
            {{-- TITLE --}}
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <div class="avatar-xs">
                        <div class="avatar-title rounded-circle bg-soft-success text-success">
                            <i class="ri-table-line"></i>
                        </div>
                    </div>
                    <span class="text-success fw-semibold fs-13 text-uppercase"> Matrix Kehadiran </span>
                </div>
                <h4 class="mb-1 fw-bold"> Presensi Kehadiran Generus </h4>
                <p class="text-muted mb-0 fs-13"> Kelompok {{ $nama_kelompok }}
                </p>
            </div>
            {{-- ACTION --}}
            <div class="d-flex gap-2 flex-wrap">
                <button data-bs-toggle="modal" data-bs-target="#ExportLaporanMatrix"
                    class="btn btn-soft-success rounded-pill px-3">
                    <i class="ri-file-excel-2-line me-1"></i> Export Matrix </button>
            </div>
        </div>
    </div>
    {{-- FILTER --}}
    <div class="card-body border-top bg-light-subtle">
        <div class="row g-3 align-items-end">
            {{-- SEARCH --}}
            <div class="col-xxl-5 col-lg-5">
                <label class="form-label fw-semibold"> Cari Nama Generus </label>
                <div class="search-box">
                    <input type="text" class="form-control border-light shadow-sm rounded-3"
                        placeholder="Ketik nama generus..." wire:model.debounce.500ms="search">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
            {{-- GENDER --}}
            <div class="col-xxl-3 col-lg-3 col-sm-6">
                <label class="form-label fw-semibold"> Gender </label>
                <select class="form-select rounded-3 shadow-sm border-light" wire:model="gender">
                    <option value="">Semua Generus</option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>
            {{-- PERIODE --}}
            <div class="col-xxl-4 col-lg-4 col-sm-12">
                <label class="form-label fw-semibold"> Periode Kehadiran </label>
                <div class="d-flex align-items-center gap-2">
                    <input type="date" class="form-control rounded-3 shadow-sm border-light"
                        wire:model.lazy="startDate">
                    <span class="text-muted fw-semibold"> — </span>
                    <input type="date" class="form-control rounded-3 shadow-sm border-light" wire:model.lazy="endDate">
                    <button type="button" class="btn btn-soft-secondary btn-icon rounded-circle flex-shrink-0"
                        wire:click="resetTanggal" title="Reset Tanggal">
                        <i class="ri-refresh-line fs-16"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- BODY --}}
    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="LaporanMatrix" class="table table-hover align-middle table-nowrap mb-0">
                {{-- HEADER --}}
                <thead class="table-light text-center align-middle">
                    <tr>
                        <th style="width:70px"> # </th>
                        <th class="text-start" style="min-width:240px;"> Nama Generus </th>
                        <th style="min-width:150px"> Kelompok </th> 
                        @foreach($tanggalMatrix as $tgl) 
                        <th style="min-width:100px">
                            <div class="fw-semibold">
                                {{ \App\Http\Controllers\HelperController::formatTanggalIndonesia($tgl, 'l') }}
                            </div>
                            <small class="text-muted">
                                {{ \App\Http\Controllers\HelperController::formatTanggalIndonesia($tgl, 'd F Y') }}
                            </small>
                        </th> 
                        @endforeach {{-- TOTAL --}}
                        <th class="bg-success-subtle text-success"> H </th>
                        <th class="bg-warning-subtle text-warning"> I </th>
                        <th class="bg-danger-subtle text-danger"> A </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody> 
                    @forelse($generusList as $i => $g) 
                    @php 
                        $total = $this->totalGenerus($g->ms_generus_id); 
                    @endphp
                    <tr>
                        {{-- NO --}}
                        <td class="text-center text-muted fw-semibold">
                            {{ $i + 1 }}
                        </td>
                        {{-- NAMA --}}
                        <td>
                            <div class="fw-semibold text-body">
                                {{ $g->nama_generus }}
                            </div>
                            <small class="text-muted">
                                {{ ucfirst($g->jenis_kelamin ?? '-') }}
                            </small>
                        </td>
                        {{-- KELOMPOK --}}
                        <td>
                            <span class="badge bg-soft-primary text-primary"> Kelompok {{ $g->ms_kelompok->nama_kelompok
                                ?? '-' }}
                            </span>
                        </td>
                        {{-- MATRIX --}} 
                        @foreach($tanggalMatrix as $tgl) 
                        @php 
                        $status = $this->status($g->ms_generus_id, $tgl); 
                        @endphp 
                        <td class="text-center"> 
                            @if($status == 'hadir')
                            <span class="badge bg-success-subtle text-success rounded-pill px-2"> H </span>
                            @elseif($status == 'izin') 
                                <span class="badge bg-warning-subtle text-warning rounded-pill px-2"> I </span> 
                            @else <span class="badge bg-danger-subtle text-danger rounded-pill px-2"> A </span> 
                            @endif 
                        </td>
                        @endforeach {{-- TOTAL HADIR --}}
                        <td class="text-center fw-bold text-success bg-success-subtle">
                            {{ $total['hadir'] }}
                        </td>
                        {{-- TOTAL IZIN --}}
                        <td class="text-center fw-bold text-warning bg-warning-subtle">
                            {{ $total['izin'] }}
                        </td>
                        {{-- TOTAL ALFA --}}
                        <td class="text-center fw-bold text-danger bg-danger-subtle">
                            {{ $total['alfa'] }}
                        </td>
                    </tr> 
                    @empty 
                    <tr>
                        <td colspan="{{ 6 + count($tanggalMatrix) }}" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-md mb-3">
                                    <div class="avatar-title rounded-circle bg-light text-muted fs-24">
                                        <i class="ri-inbox-archive-line"></i>
                                    </div>
                                </div>
                                <h6 class="mb-1"> Tidak ada data generus </h6>
                                <p class="text-muted mb-0 fs-13"> Data presensi belum tersedia pada periode ini </p>
                            </div>
                        </td>
                    </tr> 
                    @endforelse 
                </tbody>
            </table>
        </div>
    </div>
    {{-- FOOTER / LEGEND --}}
    <div class="card-footer bg-white border-top">
        <div class="d-flex flex-wrap align-items-center gap-3">
            <div class="fw-semibold text-muted"> Keterangan: </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-success-subtle text-success"> H </span>
                <small class="text-muted">Hadir</small>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-warning-subtle text-warning"> I </span>
                <small class="text-muted">Izin</small>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-danger-subtle text-danger"> A </span>
                <small class="text-muted">Alfa</small>
            </div>
        </div>
    </div>
</div>