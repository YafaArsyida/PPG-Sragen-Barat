<div>
    @forelse($this->data as $item)
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="card-header bg-white border-0 py-3 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    {{-- LEFT --}}
                    <div class="d-flex align-items-center gap-3">
                        {{-- ICON --}}
                        <div class="avatar-sm">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                                <i class="ri-book-open-line">
                                </i>
                            </div>
                        </div>
                        {{-- TITLE --}}
                        <div>
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <h5 class="fw-bold mb-0">
                                    {{ $item->nama_aspek }}
                                </h5>
                                <span class="badge bg-primary-subtle text-primary rounded-pill">
                                    {{ $item->ms_materi_kurikulum_count }} Materi
                                </span>
                                {{-- NANTI DINAMIS --}}
                                <span class="badge bg-success-subtle text-success rounded-pill">
                                    Progress 75%
                                </span>
                            </div>
                            @if($item->deskripsi)
                            <small class="text-muted">
                                {{ $item->deskripsi }}
                            </small>
                            @else
                            <small class="text-muted">
                                Penilaian pembinaan generus
                            </small>
                            @endif
                        </div>
                    </div>
                    {{-- RIGHT --}}
                    <button class="btn btn-light btn-icon rounded-circle" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $item->ms_aspek_kurikulum_id }}">
                        <i class="ri-arrow-down-s-line fs-18">
                        </i>
                    </button>
                </div>
            </div>
            {{-- COLLAPSE --}}
            <div class="collapse {{ $loop->first ? 'show' : '' }}" id="collapse{{ $item->ms_aspek_kurikulum_id }}">
                <div class="card-body pt-0 px-4 pb-4">
                    {{-- LIST MATERI --}}
                    <div class="d-flex flex-column gap-3">
                        @livewire( 'penilaian-kurikulum.evaluation', [ 
                            'ms_aspek_kurikulum_id' => $item->ms_aspek_kurikulum_id, 
                            'ms_kelompok_id' => $this->selectedKelompok, 
                            'ms_periode_kurikulum_id' => $this->selectedPeriode, 
                            'ms_jenjang_kurikulum_id' => $this->selectedJenjang, 
                        ], key( 'evaluation-' . $item->ms_aspek_kurikulum_id . '-' . $this->selectedKelompok . '-' . $this->selectedPeriode . '-' . $this->selectedJenjang ) )
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    {{-- EMPTY STATE --}}
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body py-5 text-center">
                {{-- ICON --}}
                <div class="avatar-lg mx-auto mb-4">
                    <div class="avatar-title bg-light text-muted rounded-circle">
                        <i class="ri-book-open-line fs-1">
                        </i>
                    </div>
                </div>
                {{-- TITLE --}}
                <h5 class="fw-semibold mb-2">
                    Belum Ada Data Kurikulum
                </h5>
                {{-- DESC --}}
                <p class="text-muted mb-0">
                    @if(!$selectedPeriode || !$selectedJenjang) Pilih periode dan jenjang
                    terlebih dahulu untuk menampilkan aspek kurikulum. 
                    @else Belum ada aspek
                    kurikulum pada periode dan jenjang yang dipilih. 
                    @endif
                </p>
            </div>
        </div>
    </div>
    @endforelse
</div>