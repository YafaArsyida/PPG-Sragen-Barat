 <div class="row g-3 mt-2">
    {{-- RANKING --}}
    <div class="col-12 col-xl-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="card-header bg-white border-0 py-4">

                {{-- HEADER --}}
                <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">

                    {{-- TITLE --}}
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <div class="avatar-sm">
                                <div class="avatar-title bg-warning-subtle text-warning rounded-circle fs-18">
                                    <i class="ri-trophy-line"></i>
                                </div>
                            </div>

                            <div>
                                <h5 class="modal-title fw-bold mb-0">
                                    Kehadiran Generus
                                </h5>
                                <small class="text-muted">
                                    Generus dengan kehadiran terbaik
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- PERIODE --}}
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

                {{-- FILTER --}}
                <div class="row g-2 mt-3">

                    {{-- SEARCH --}}
                    <div class="col-6 col-sm-6">
                        <div class="search-box">
                            <input type="text"
                                class="form-control rounded-3"
                                placeholder="Cari nama generus..."
                                wire:model.debounce.500ms="searchGenerus">

                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>

                    {{-- KELOMPOK --}}
                    <div class="col-6 col-sm-6">
                        <select class="form-select rounded-3"
                            wire:model="selectedKelompok">
                            <option value="">
                                Semua Kelompok
                            </option>

                            @foreach($listKelompok as $kelompok)
                                <option value="{{ $kelompok->ms_kelompok_id }}">
                                    {{ $kelompok->nama_kelompok }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

            </div>
            {{-- TABLE --}}
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr class="text-uppercase fw-semibold">
                                <th width="30px" class="">No</th>
                                <th class="">Generus</th>
                                <th class="text-center">Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $index => $item) 
                            <tr>
                                {{-- RANK --}}
                                <td class="text-muted text-center">
                                    {{ $data->firstItem() + $index }}.
                                </td>
                                {{-- NAMA --}}
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-xs flex-shrink-0">
                                            <div class="avatar-title {{ $item->ms_generus->jenis_kelamin == 'perempuan'
                                                ? 'bg-danger-subtle text-danger'
                                                : 'bg-primary-subtle text-primary' 
                                                }} 
                                                rounded-circle fw-semibold">
                                                {{ strtoupper(substr($item->ms_generus->nama_generus ?? 'G', 0, 1)) }}
                                            </div>
                                        </div>
                                        <div>
                                            <div class="fw-semibold text-body">
                                                {{ $item->ms_generus->nama_generus ?? '-' }}
                                            </div>
                                            <small>
                                                {{ $item->ms_generus->ms_kelompok->nama_kelompok ?? '-' }}
                                            </small>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <button type="button"
                                        class="btn btn-sm btn-primary px-3 py-2 rounded-pill fw-semibold border-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#ModalDetailKegiatanGenerus"
                                        wire:click="$emit('DetailKegiatanGenerus', {{ $item->ms_generus_id }})">

                                        <i class="ri-checkbox-circle-line me-1"></i>
                                        {{ $item->total_hadir }}x Hadir
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="avatar-md mb-3">
                                            <div class="avatar-title bg-light text-muted rounded-circle fs-2">
                                                <i class="ri-bar-chart-grouped-line">
                                                </i>
                                            </div>
                                        </div>
                                        <h6 class="fw-semibold mb-1">
                                            Belum Ada Data Kehadiran
                                        </h6>
                                        <p class="text-muted mb-0 fs-13">
                                            Ranking kehadiran generus akan tampil di sini.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
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
                                data generus
                            </div>
                            <div>
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

    </div>

</div>