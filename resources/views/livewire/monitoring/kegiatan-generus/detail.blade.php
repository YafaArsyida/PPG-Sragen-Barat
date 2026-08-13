<div wire:ignore.self
    class="modal fade"
    id="ModalDetailKegiatanGenerus"
    tabindex="-1"
    aria-labelledby="ModalDetailKegiatanGenerusLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- HEADER --}}
            <div class="modal-header border-0 p-4 pb-0">

                <div class="d-flex align-items-center gap-3">

                    <div class="avatar-sm">
                        <div class="avatar-title bg-success-subtle text-success rounded-circle fs-20">
                            <i class="ri-calendar-check-line"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1" id="ModalDetailKegiatanGenerusLabel">
                            Riwayat Kehadiran
                        </h5>

                        <small class="text-muted">
                            Daftar kegiatan yang dihadiri generus
                        </small>
                    </div>

                </div>

                <button type="button"
                    class="btn btn-light btn-icon rounded-circle"
                    data-bs-dismiss="modal">
                    <i class="ri-close-line fs-18"></i>
                </button>

            </div>

            {{-- BODY --}}
            <div class="modal-body p-4">

                @if($generus)
                    {{-- INFO GENERUS --}}
                    <div class="card border-0 bg-light-subtle rounded-4 mb-4">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center gap-3">

                                <div class="avatar-md flex-shrink-0">
                                    <div class="avatar-title
                                        {{ $generus->jenis_kelamin == 'perempuan'
                                            ? 'bg-danger-subtle text-danger'
                                            : 'bg-primary-subtle text-primary'
                                        }}
                                        rounded-circle fs-20 fw-bold">
                                        {{ strtoupper(substr($generus->nama_generus ?? 'G', 0, 1)) }}
                                    </div>
                                </div>

                                <div class="min-w-0">
                                    <h5 class="fw-bold mb-1 text-truncate">
                                        {{ $generus->nama_generus }}
                                    </h5>

                                    {{-- UMUR --}}
                                    <div class="small text-muted mb-2">
                                        @if($generus->tanggal_lahir)
                                            {{ \Carbon\Carbon::parse($generus->tanggal_lahir)->age }} Tahun
                                            <span class="mx-1">•</span>
                                            {{ \Carbon\Carbon::parse($generus->tanggal_lahir)->format('d M Y') }}
                                        @else
                                            Umur tidak tersedia
                                        @endif
                                    </div>

                                    <div class="d-flex align-items-center gap-2 flex-wrap">

                                        {{-- KELOMPOK --}}
                                        <span class="badge bg-primary-subtle text-primary rounded-pill">
                                            <i class="ri-team-line me-1"></i>
                                            {{ $generus->ms_kelompok->nama_kelompok ?? '-' }}
                                        </span>

                                        {{-- DESA --}}
                                        <span class="badge bg-success-subtle text-success rounded-pill">
                                            <i class="ri-map-pin-line me-1"></i>
                                            {{ $generus->ms_kelompok->ms_desa->nama_desa ?? '-' }}
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TOTAL --}}
                    <div class="d-flex align-items-center justify-content-between mb-3">

                        <div>
                            <h6 class="fw-bold mb-1">
                                Rekap Kehadiran Generus
                            </h6>

                            <small class="text-muted">
                                Riwayat kehadiran pada kegiatan yang diikuti
                            </small>
                        </div>

                        <div class="flex-shrink-0">
                            <select wire:model="periode"
                                class="form-select fw-semibold rounded-pill bg-primary-subtle text-primary border-0 shadow-sm">

                                <option value="1bulan">
                                    1 Bulan
                                </option>

                                <option value="3bulan">
                                    3 Bulan
                                </option>

                                <option value="1tahun">
                                    1 Tahun
                                </option>

                            </select>
                        </div>

                    </div>

                    {{-- TABLE --}}
                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">
                                <tr>
                                    <th width="50" class="text-center">
                                        #
                                    </th>

                                    <th>
                                        Kegiatan
                                    </th>

                                    <th>
                                        Tanggal
                                    </th>

                                    <th>
                                        Kehadiran
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($presensi as $index => $item)

                                    <tr>

                                        {{-- NO --}}
                                        <td class="text-center text-muted fw-semibold">
                                            {{ $index + 1 }}
                                        </td>

                                        {{-- KEGIATAN --}}
                                        <td>
                                            <div class="fw-semibold text-dark">
                                                {{ $item->ms_kegiatan_generus->nama_kegiatan ?? '-' }}
                                            </div>

                                            @php
                                                $lokasi = $item->ms_kegiatan_generus?->lokasi_final ?? [
                                                    'tempat' => '-',
                                                    'alamat' => '-',
                                                    'peta' => null,
                                                ];
                                            @endphp

                                            <i class="ri-map-pin-line text-danger me-1"></i>
                                            {{ $lokasi['tempat'] }}
                                        </td>

                                        {{-- TANGGAL --}}
                                        <td>
                                            <span class="text-nowrap">
                                                {{ $item->tanggal_presensi
                                                    ? \App\Http\Controllers\HelperController::formatTanggalIndonesia($item->tanggal_presensi, 'd F Y')
                                                    : '-' }}
                                            </span>
                                        </td>
                                        {{-- Kehadiran --}}
                                        <td>
                                            @if($item->status_hadir === 'hadir')
                                                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                                                    <i class="ri-checkbox-circle-line me-1"></i>
                                                    Hadir
                                                </span>
                                            @elseif($item->status_hadir === 'izin')
                                                <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2">
                                                    <i class="ri-information-line me-1"></i>
                                                    Izin
                                                </span>
                                            @else
                                                <span class="badge bg-light text-muted rounded-pill px-3 py-2">
                                                    {{ ucfirst($item->status_hadir ?? '-') }}
                                                </span>
                                            @endif
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="text-center py-5">

                                            <div class="text-muted">

                                                <i class="ri-calendar-close-line fs-36 d-block mb-2"></i>

                                                <div class="fw-semibold">
                                                    Belum ada riwayat kehadiran
                                                </div>

                                                <small>
                                                    Generus belum memiliki data presensi.
                                                </small>

                                            </div>

                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                @else

                    {{-- EMPTY STATE --}}
                    <div class="text-center py-5 text-muted">

                        <i class="ri-user-search-line fs-36 d-block mb-2"></i>

                        <div class="fw-semibold">
                            Pilih generus terlebih dahulu
                        </div>

                    </div>

                @endif

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer border-0 px-4 pb-4 pt-0">

                <button type="button"
                    class="btn btn-light rounded-pill px-4"
                    data-bs-dismiss="modal">

                    <i class="ri-close-line me-1"></i>
                    Tutup

                </button>

            </div>

        </div>
    </div>
</div>