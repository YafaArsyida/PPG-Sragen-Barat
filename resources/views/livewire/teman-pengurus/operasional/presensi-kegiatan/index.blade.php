<div class="row justify-content-center g-3 p-3">
    {{-- ================= HEADER KEGIATAN ================= --}}
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            {{-- TOP BAR --}}
            <div class="bg-primary bg-gradient" style="height: 5px;">
            </div>
            <div class="card-body p-4">
                <div class="row g-4 align-items-center">
                    {{-- LEFT --}}
                    <div class="col-lg-7">
                        <div class="d-flex align-items-start gap-3">
                            {{-- ICON --}}
                            <div class="avatar-md flex-shrink-0">
                                <div class="avatar-title rounded-circle bg-primary-subtle text-primary fs-2 shadow-sm">
                                    <i class="ri-calendar-event-line">
                                    </i>
                                </div>
                            </div>
                            {{-- CONTENT --}}
                            <div class="flex-grow-1">
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                                        Kegiatan Pengurus
                                    </span>
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                                        Bidang PPG
                                    </span>
                                    <span class="badge bg-info-subtle text-info rounded-pill px-3 py-2">
                                        Pengurus
                                    </span>
                                </div>
                                <h3 class="fw-bold mb-2">
                                    {{ $kegiatan->nama_kegiatan }}
                                </h3>
                                @if($kegiatan->deskripsi)
                                <p class="text-muted mb-3">
                                    {{ $kegiatan->deskripsi }}
                                </p>
                                @endif
                                {{-- META --}}
                                <div class="d-flex flex-wrap gap-2 text-muted fs-14">
                                    <small>
                                        <i class="ri-map-pin-line text-danger me-1">
                                        </i>
                                        {{ $kegiatan->tempat }}
                                    </small>
                                    <small>
                                        <i class="ri-calendar-line text-success me-1">
                                        </i>
                                        {{ \App\Http\Controllers\HelperController::formatTanggalIndonesia(
                                        $kegiatan->tanggal,
                                        'd F Y' ) }}
                                    </small>
                                    <small>
                                        <i class="ri-time-line text-warning me-1">
                                        </i>
                                        {{ $kegiatan->waktu }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- RIGHT --}}
                    <div class="col-lg-5 text-lg-end">
                        <div class="d-flex flex-column gap-3 align-items-lg-end">
                            {{-- SUMMARY --}}
                            <div class="d-flex gap-3 flex-wrap justify-content-lg-end">
                                <div class="border rounded-4 px-3 py-2 text-center bg-success-subtle">
                                    <div class="fw-bold fs-5 text-success">
                                        {{ collect($presensiMap)->filter(fn($v) => $v === 'hadir')->count() }}
                                    </div>
                                    <small class="text-muted">
                                        Hadir
                                    </small>
                                </div>
                                <div class="border rounded-4 px-3 py-2 text-center bg-danger-subtle">
                                    <div class="fw-bold fs-5 text-danger">
                                        {{ collect($presensiMap)->filter(fn($v) => $v === 'izin')->count() }}
                                    </div>
                                    <small class="text-muted">
                                        Izin
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-top border-bottom bg-light-subtle">
                <div class="row g-3 align-items-end">
                    {{-- SEARCH --}}
                    <div class="col-lg-4">
                        <label class="form-label fw-semibold">
                            Cari pengurus
                        </label>
                        <div class="search-box">
                            <input type="text" class="form-control rounded-3" placeholder="Cari nama pengurus..."
                                wire:model.debounce.500ms="searchPengurus">
                            <i class="ri-search-line search-icon">
                            </i>
                        </div>
                    </div>
                    {{-- KELOMPOK --}}
                    <div class="col-lg-4">
                        <label class="form-label fw-semibold">
                            Dapukan
                        </label>
                        <select class="form-select" wire:model="ms_dapukan_id">
                            <option value="">
                                Semua Dapukan
                            </option>
                            @foreach($listDapukan as $item)
                            <option value="{{ $item->ms_dapukan_id }}">
                                {{ $item->nama_dapukan }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- GENDER --}}
                    <div class="col-lg-2">
                        <label class="form-label fw-semibold">
                            L / P
                        </label>
                        <select class="form-select rounded-3" wire:model="genderPengurus">
                            <option value="">
                                Semua
                            </option>
                            <option value="laki-laki">
                                L
                            </option>
                            <option value="perempuan">
                                P
                            </option>
                        </select>
                    </div>
                    {{-- JENJANG --}}
                    <div class="col-lg-2">
                        <label class="form-label fw-semibold">
                            Peserta
                        </label>
                        <div class="alert alert-primary py-2 px-3 mb-0 rounded-3 text-center">
                            <strong>
                                PENGURUS
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- TABLE --}}
                <div class="table-responsive" style="max-height: 850px;">
                    <table class="table align-middle table-hover mb-0">
                        <thead class="table-light sticky-top z-1">
                            <tr class="text-uppercase fw-semibold">
                                <th width="60">
                                    #
                                </th>
                                <th>
                                    Pengurus
                                </th>
                                <th>
                                    Kelompok
                                </th>
                                <th style="white-space: nowrap" class="text-center">
                                    Presensi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($this->listPengurus as $i => $g) @php $status = $presensiMap[$g->ms_pengurus_id]
                            ?? null; @endphp
                            <tr wire:key="pengurus-{{ $g->ms_pengurus_id }}">
                                <td class="fw-semibold">
                                    {{ $this->listPengurus->firstItem() + $i }}
                                </td>
                                <td class="fw-semibold">
                                    {{ $g->nama_pengurus }}
                                </td>
                                <td>
                                    Kelompok {{ $g->ms_kelompok->nama_kelompok ?? '-' }}
                                </td>
                                {{-- ACTION --}}
                                <td class="text-center text-nowrap" wire:key="action-{{ $g->ms_pengurus_id }}-{{ $status }}">
                                    @if(!$status)
                                    <div class="d-inline-flex align-items-center gap-2 flex-nowrap">
                                        <button class="btn btn-success btn-sm rounded-pill px-3"
                                            wire:click.prevent="hadir({{ $g->ms_pengurus_id }})" wire:loading.attr="disabled"
                                            wire:target="hadir({{ $g->ms_pengurus_id }})" style="touch-action: manipulation;">
                                            <i class="ri-check-line me-1">
                                            </i>
                                            Hadir
                                        </button>
                                        <button class="btn btn-soft-danger btn-sm rounded-pill px-3"
                                            wire:click.prevent="izin({{ $g->ms_pengurus_id }})" wire:loading.attr="disabled"
                                            wire:target="izin({{ $g->ms_pengurus_id }})" style="touch-action: manipulation;">
                                            <i class="ri-close-line me-1">
                                            </i>
                                            Izin
                                        </button>
                                    </div>
                                    @elseif($status === 'hadir')
                                    <div class="d-inline-flex align-items-center gap-2 flex-nowrap">
                                        <button class="btn btn-soft-success btn-sm rounded-pill px-3" disabled>
                                            <i class="ri-check-double-line me-1">
                                            </i>
                                            Sudah Hadir
                                        </button>
                                        <a class="text-danger small fw-semibold text-decoration-none"
                                            wire:click.prevent="batalPresensi({{ $g->ms_pengurus_id }})" wire:loading.attr="disabled"
                                            wire:target="batalPresensi({{ $g->ms_pengurus_id }})" style="cursor:pointer;">
                                            Batalkan
                                        </a>
                                    </div>
                                    @elseif($status === 'izin')
                                    <div class="d-inline-flex align-items-center gap-2 flex-nowrap">
                                        <button class="btn btn-soft-warning btn-sm rounded-pill px-3" disabled>
                                            <i class="ri-error-warning-line me-1">
                                            </i>
                                            Izin
                                        </button>
                                        <a class="text-danger small fw-semibold text-decoration-none"
                                            wire:click.prevent="batalPresensi({{ $g->ms_pengurus_id }})" wire:loading.attr="disabled"
                                            wire:target="batalPresensi({{ $g->ms_pengurus_id }})" style="cursor:pointer;">
                                            Batalkan
                                        </a>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="ri-inbox-line fs-1 d-block mb-2">
                                    </i>
                                    Tidak ada data pengurus
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>