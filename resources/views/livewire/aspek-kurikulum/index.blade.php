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
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="fw-bold mb-0">
                                    {{ $item->nama_aspek }}
                                </h5>
                                {{-- <span class="badge bg-primary-subtle text-primary rounded-pill">
                                    {{ $item->ms_materi_kurikulum_count }} Materi
                                </span> --}}
                            </div>
                            <small class="text-muted">
                                {{ $item->deskripsi }}
                            </small>
                        </div>
                    </div>
                    {{-- RIGHT --}}
                    <div class="d-flex align-items-center gap-2">
                        {{-- DROPDOWN --}}
                        <div class="dropdown">
                            <button class="btn btn-light btn-icon rounded-circle" data-bs-toggle="dropdown">
                                <i class="ri-more-2-fill">
                                </i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-4">
                                <li>
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#AspekEdit" wire:click.prevent="$emit('AspekEdit', {{ $item->ms_aspek_kurikulum_id }})">
                                        <i class="ri-pencil-line me-2"></i>
                                        Edit Aspek
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item text-danger"data-bs-toggle="modal"
                                        data-bs-target="#DeleteAspek" wire:click.prevent="$emit('AspekDelete', {{ $item->ms_aspek_kurikulum_id }})">
                                        <i class="ri-delete-bin-line me-2"></i>
                                        Hapus Aspek
                                    </button>
                                </li>
                            </ul>
                        </div>
                        {{-- COLLAPSE BUTTON --}}
                        <button class="btn btn-light btn-icon rounded-circle" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $item->ms_aspek_kurikulum_id }}">
                            <i class="ri-arrow-down-s-line">
                            </i>
                        </button>
                    </div>
                </div>
            </div>
            {{-- COLLAPSE --}}
            <div class="collapse {{ $loop->first ? 'show' : '' }}" id="collapse{{ $item->ms_aspek_kurikulum_id }}">
                <div class="card-body pt-0 px-4 pb-4">
                    {{-- LIST MATERI --}}
                    <div class="d-flex flex-column gap-3">
                        @livewire( 'materi-kurikulum.index', [ 'ms_aspek_kurikulum_id' => $item->ms_aspek_kurikulum_id
                        ], key('materi-'.$item->ms_aspek_kurikulum_id) )
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body py-5 text-center">
                <div class="avatar-lg mx-auto mb-4">
                    <div class="avatar-title bg-light text-muted rounded-circle">
                        <i class="ri-book-open-line fs-1">
                        </i>
                    </div>
                </div>
                <h5 class="fw-semibold">
                    Belum Ada Aspek Kurikulum
                </h5>
                <p class="text-muted mb-4">
                    Tambahkan aspek kurikulum untuk mulai menyusun materi pembelajaran generus.
                </p>
                <button class="btn btn-primary rounded-pill px-4"data-bs-toggle="modal"
                    data-bs-target="#AspekCreate"
                    wire:click.prevent="$emit(
                        'AspekCreate',
                        {
                            periode: {{ $selectedPeriode }},
                            jenjang: {{ $selectedJenjang }}
                        })">
                    <i class="ri-add-line me-1"></i>Tambah Aspek
                </button>
            </div>
        </div>
    </div>
    @endforelse
    {{-- ACTION BOTTOM --}}
    <div class="col-12">
        <button class="btn btn-primary rounded-pill px-4 py-2"data-bs-toggle="modal" data-bs-target="#AspekCreate"
            wire:click.prevent="$emit(
                'AspekCreate',
                {
                    periode: {{ $selectedPeriode }},
                    jenjang: {{ $selectedJenjang }}
                })">
            <i class="ri-add-line me-1"></i>
            Tambah Aspek Kurikulum
        </button>
    </div>
</div>
