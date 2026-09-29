<div class="row justify-content-center g-4">
    {{-- ================= HEADER KEGIATAN ================= --}}
    <div class="col-xl-4">
        <div>
            {{-- HEADER KEGIATAN --}}
            <div class="row g-3 align-items-center mb-2">

                {{-- INFO KEGIATAN --}}
                <div class="col-lg-8 col-sm-6">
                    <div>
                        {{-- SCOPE --}}
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                                <i class="ri-map-pin-user-line me-1"></i>

                                @if ($kegiatan->scope === 'daerah')
                                    Daerah Sragen Barat
                                @elseif ($kegiatan->scope === 'desa')
                                    Desa {{ $kegiatan->ms_desa->nama_desa ?? '-' }}
                                @elseif ($kegiatan->scope === 'kelompok')
                                    Kelompok {{ $kegiatan->ms_kelompok->nama_kelompok ?? '-' }}
                                @endif
                            </span>
                        </div>

                        {{-- NAMA KEGIATAN --}}
                        <h3 class="fw-semibold mb-1">
                            {{ $kegiatan->nama_kegiatan }}
                        </h3>

                        {{-- TEMPAT --}}
                        <p class="text-muted mb-0">
                            <i class="ri-map-pin-line me-1"></i>
                            {{ $kegiatan->lokasi_final['tempat'] ?? '-' }}
                        </p>

                    </div>
                </div>

                {{-- PARAMETER DESA --}}
                @if ($kegiatan->scope === 'daerah')
                    <div class="col-lg-4 col-sm-6">
                        <div class="d-flex justify-content-lg-end">
                            @livewire('parameter.desa')
                        </div>
                    </div>
                @endif

            </div>


            {{-- FILTER --}}
            <div class="border-top border-bottom bg-light-subtle py-3">
                <div class="row g-3 align-items-end">

                    {{-- SEARCH --}}
                    <div class="col-lg-6 col-md-4 col-sm-12">
                        <label class="form-label fw-semibold">
                            Cari Generus
                        </label>

                        <div class="search-box">
                            <input
                                type="text"
                                class="form-control rounded-3"
                                placeholder="Cari nama generus..."
                                wire:model.debounce.500ms="searchGenerus"
                            >

                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>

                    {{-- KELOMPOK --}}
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <label class="form-label fw-semibold">
                            Kelompok
                        </label>

                        <select
                            class="form-select rounded-3"
                            wire:model="kelompokGenerus"
                        >
                            <option value="">
                                Semua Kelompok
                            </option>

                            @foreach ($listKelompok as $k)
                                <option value="{{ $k->ms_kelompok_id }}">
                                    Kelompok {{ $k->nama_kelompok }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- GENDER --}}
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <label class="form-label fw-semibold">
                            L / P
                        </label>

                        <select
                            class="form-select rounded-3"
                            wire:model="genderGenerus"
                        >
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

                </div>
            </div>


            {{-- TABLE --}}
            <div class="table-responsive" style="max-height: 850px;">
                <table class="table align-middle table-hover mb-0">

                    <thead class="table-light sticky-top z-1">
                        <tr class="text-uppercase fw-semibold">
                            <th width="60">
                                #
                            </th>

                            <th>
                                Generus
                            </th>

                            <th>
                                Kelompok
                            </th>

                            <th
                                style="white-space: nowrap"
                                class="text-center"
                            >
                                Presensi
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($this->listGenerus as $i => $g)

                            @php
                                $status = $presensiMap[$g->ms_generus_id] ?? null;
                            @endphp

                            <tr wire:key="generus-{{ $g->ms_generus_id }}">

                                <td class="fw-semibold">
                                    {{ $this->listGenerus->firstItem() + $i }}
                                </td>

                                <td>
                                    <div class="d-flex align-items-center gap-3">

                                        <div class="avatar-xs flex-shrink-0">
                                            <div
                                                class="avatar-title
                                                    {{ $g->jenis_kelamin == 'perempuan'
                                                        ? 'bg-danger-subtle text-danger'
                                                        : 'bg-primary-subtle text-primary'
                                                    }}
                                                    rounded-circle fw-semibold"
                                            >
                                                {{ strtoupper(substr($g->nama_generus, 0, 1)) }}
                                            </div>
                                        </div>

                                        <div>
                                            <div class="fw-semibold">
                                                {{ $g->nama_generus }}
                                            </div>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    {{ $g->ms_kelompok->nama_kelompok ?? '-' }}
                                </td>

                                <td
                                    class="text-center text-nowrap"
                                    wire:key="action-{{ $g->ms_generus_id }}-{{ $status }}"
                                >
                                    @if (!$status)

                                        <div class="d-inline-flex align-items-center gap-2 flex-nowrap">

                                            <button
                                                class="btn btn-success btn-sm rounded-pill px-3"
                                                wire:click.prevent="hadir({{ $g->ms_generus_id }})"
                                                wire:loading.attr="disabled"
                                                wire:target="hadir({{ $g->ms_generus_id }})"
                                                style="touch-action: manipulation;"
                                            >
                                                <i class="ri-check-line me-1"></i>
                                                Hadir
                                            </button>

                                            <button
                                                class="btn btn-soft-danger btn-sm rounded-pill px-3"
                                                wire:click.prevent="izin({{ $g->ms_generus_id }})"
                                                wire:loading.attr="disabled"
                                                wire:target="izin({{ $g->ms_generus_id }})"
                                                style="touch-action: manipulation;"
                                            >
                                                <i class="ri-close-line me-1"></i>
                                                Izin
                                            </button>

                                        </div>

                                    @elseif ($status === 'hadir')

                                        <div class="d-inline-flex align-items-center gap-2 flex-nowrap">

                                            <button
                                                class="btn btn-soft-success btn-sm rounded-pill px-3"
                                                disabled
                                            >
                                                <i class="ri-check-double-line me-1"></i>
                                                Sudah Hadir
                                            </button>

                                            <a
                                                class="text-danger small fw-semibold text-decoration-none"
                                                wire:click.prevent="batalPresensi({{ $g->ms_generus_id }})"
                                                wire:loading.attr="disabled"
                                                wire:target="batalPresensi({{ $g->ms_generus_id }})"
                                                style="cursor: pointer;"
                                            >
                                                Batalkan
                                            </a>

                                        </div>

                                    @elseif ($status === 'izin')

                                        <div class="d-inline-flex align-items-center gap-2 flex-nowrap">

                                            <button
                                                class="btn btn-soft-warning btn-sm rounded-pill px-3"
                                                disabled
                                            >
                                                <i class="ri-error-warning-line me-1"></i>
                                                Izin
                                            </button>

                                            <a
                                                class="text-danger small fw-semibold text-decoration-none"
                                                wire:click.prevent="batalPresensi({{ $g->ms_generus_id }})"
                                                wire:loading.attr="disabled"
                                                wire:target="batalPresensi({{ $g->ms_generus_id }})"
                                                style="cursor: pointer;"
                                            >
                                                Batalkan
                                            </a>

                                        </div>

                                    @endif
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td
                                    colspan="4"
                                    class="text-center text-muted py-5"
                                >
                                    <i class="ri-inbox-line fs-1 d-block mb-2"></i>
                                    Tidak ada data generus
                                </td>
                            </tr>

                        @endforelse
                    </tbody>

                </table>
            </div>
            <div class="mt-2">
                {{ $this->listGenerus->links() }}
            </div>
        </div>
    </div>
</div>