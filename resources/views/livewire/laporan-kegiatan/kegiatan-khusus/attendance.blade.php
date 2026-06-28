<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white border-0 p-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <h5 class="fw-bold mb-1">Matrix Kehadiran Generus</h5>
                <p class="text-muted mb-0">Laporan kehadiran per peserta berdasarkan tanggal kegiatan</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <button wire:click.prevent class="btn btn-soft-success rounded-pill px-3">
                    <i class="ri-file-excel-2-line me-1"></i> Export Matrix
                </button>
            </div>
        </div>
    </div>

    <div class="card-body border-top bg-light-subtle">
        <div class="row g-3 align-items-end">
            <div class="col-xxl-6 col-lg-6">
                <label class="form-label fw-semibold">Cari Nama Generus</label>
                <div class="search-box">
                    <input type="text" class="form-control rounded-3" placeholder="Ketik nama generus..."
                        wire:model.debounce.500ms="search">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
            <div class="col-xxl-3 col-lg-3 col-sm-6">
                <label class="form-label fw-semibold">Kelompok</label>
                <select class="form-select rounded-3" wire:model="ms_kelompok_id" {{ !$ms_desa_id ? 'disabled' : '' }}>
                    <option value="">Semua Kelompok</option>
                    @foreach($listKelompok as $kelompok)
                    <option value="{{ $kelompok->ms_kelompok_id }}">
                        Kelompok {{ $kelompok->nama_kelompok }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-xxl-3 col-lg-3 col-sm-6">
                <label class="form-label fw-semibold">Gender</label>
                <select class="form-select rounded-3" wire:model="gender">
                    <option value="">Semua Generus</option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle table-nowrap mb-0">
                <thead class="table-light text-center align-middle">
                    <tr>
                        <th style="width:70px">#</th>
                        <th class="text-start" style="min-width:240px;">Nama Generus</th>
                        <th style="min-width:150px">Kelompok</th>
                        @foreach($tanggalMatrix as $tgl)
                        <th style="min-width:100px">
                            <div class="fw-semibold">{{ \App\Http\Controllers\HelperController::formatTanggalIndonesia($tgl, 'l') }}</div>
                            <small class="text-muted">{{ \App\Http\Controllers\HelperController::formatTanggalIndonesia($tgl, 'd F Y') }}</small>
                        </th>
                        @endforeach
                        <th class="bg-success-subtle text-success">H</th>
                        <th class="bg-warning-subtle text-warning">I</th>
                        <th class="bg-danger-subtle text-danger">A</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($generusList as $index => $g)
                    @php $total = $this->totalGenerus($g->ms_generus_id); @endphp
                    <tr>
                        <td class="text-center text-muted fw-semibold">{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-xs flex-shrink-0">
                                    <div class="avatar-title 
                                        {{ $g->jenis_kelamin == 'perempuan'
                                        ? 'bg-danger-subtle text-danger'
                                        : 'bg-primary-subtle text-primary' 
                                        }} 
                                        rounded-circle fw-semibold">
                                        {{ strtoupper(substr($g->nama_generus, 0, 1)) }}
                                    </div>
                                </div>
                                <div>
                                    <div class="fw-semibold">
                                        {{ $g->nama_generus }}
                                    </div>
                                    <small class="text-muted">
                                        {{ strtoupper($g->jenis_kelamin) }}
                                    </small>
                                </div>
                            </div>
                        </td>
                        <td class= "fw-semibold">
                            Kelompok {{ $g->ms_kelompok->nama_kelompok ?? '-' }}
                        </td>
                        @foreach($tanggalMatrix as $tgl)
                        @php $status = $this->status($g->ms_generus_id, $tgl); @endphp
                        <td class="text-center">
                            @if($status === 'hadir')
                            <span class="badge bg-success-subtle text-success rounded-pill px-2">H</span>
                            @elseif($status === 'izin')
                            <span class="badge bg-warning-subtle text-warning rounded-pill px-2">I</span>
                            @else
                            <span class="badge bg-danger-subtle text-danger rounded-pill px-2">A</span>
                            @endif
                        </td>
                        @endforeach
                        <td class="text-center fw-bold text-success bg-success-subtle">{{ $total['hadir'] }}</td>
                        <td class="text-center fw-bold text-warning bg-warning-subtle">{{ $total['izin'] }}</td>
                        <td class="text-center fw-bold text-danger bg-danger-subtle">{{ $total['alfa'] }}</td>
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
                                <h6 class="mb-1">Tidak ada data generus</h6>
                                <p class="text-muted mb-0 fs-13">Data presensi belum tersedia pada periode ini</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer bg-white border-top">
        <div class="d-flex flex-wrap align-items-center gap-3">
            <div class="fw-semibold text-muted">Keterangan:</div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-success-subtle text-success">H</span>
                <small class="text-muted">Hadir</small>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-warning-subtle text-warning">I</span>
                <small class="text-muted">Izin</small>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-danger-subtle text-danger">A</span>
                <small class="text-muted">Alfa</small>
            </div>
        </div>
    </div>
</div>
