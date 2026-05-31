<div>
    @foreach($jenjangs as $item)
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <div class="card-header bg-white border-0 py-3 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-success-subtle text-success rounded-circle fs-20">
                            <i class="ri-graduation-cap-line">
                            </i>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex align-items-center flex-wrap gap-2 mb-1">
                            <h5 class="fw-bold mb-0">
                                {{ $item->nama_jenjang }}
                            </h5>
                            <span class="badge bg-light text-dark border">
                                {{ $item->jumlah_kelompok }} Kelompok
                            </span>
                            <span class="badge bg-light text-dark border">
                                {{ $item->jumlah_materi }} Materi
                            </span>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-success-subtle text-success px-3 py-2">
                                Kehadiran {{ $item->avg_kehadiran }}%
                            </span>
                            <span class="badge bg-primary-subtle text-primary px-3 py-2">
                                Keberhasilan {{ $item->avg_keberhasilan }}%
                            </span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-light rounded-circle" data-bs-toggle="collapse"
                    data-bs-target="#collapse{{ $item->ms_jenjang_kurikulum_id }}">
                    <i class="ri-arrow-down-s-line fs-18">
                    </i>
                </button>
            </div>
        </div>
        <div class="collapse {{ $loop->first ? 'show' : '' }}" id="collapse{{ $item->ms_jenjang_kurikulum_id }}">
            <div class="card-body px-4 pb-4">
                @livewire('monitoring-kurikulum.report', [
                    'ms_jenjang_kurikulum_id' => $item->ms_jenjang_kurikulum_id, 
                    'ms_desa_id' => $this->selectedDesa,
                    'ms_periode_kurikulum_id' => $this->selectedPeriode, 
                ], key( 'monitoring-kurikulum-' . $item->ms_jenjang_kurikulum_id . '-' . $this->selectedDesa . '-' . $this->selectedPeriode) )
            </div>
        </div>
    </div>
    @endforeach
</div>