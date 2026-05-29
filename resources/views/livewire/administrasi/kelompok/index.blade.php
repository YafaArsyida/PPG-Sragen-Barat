<div class="card border-0 shadow-sm rounded-4 overflow-hidden" id="produkList">
    {{-- HEADER --}}
    <div class="card-header bg-white border-0 p-4">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4">
            {{-- TITLE --}}
            <div>
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-community-line">
                            </i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">
                            Administrasi Data Kelompok
                        </h5>
                        <small>
                            Kelola data desa, kelompok, dan generus binaan
                        </small>
                    </div>
                </div>
            </div>
            {{-- ACTION --}}
            <div class="d-flex gap-2 flex-wrap">
                <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDesa" aria-controls="offcanvasDesa">
                    <i class="ri-building-line me-1">
                    </i>
                    Master Desa
                </button>
                <button type="button" class="btn btn-success rounded-pill px-4" data-bs-toggle="modal"
                    data-bs-target="#ModalKelompokCreate" wire:click="$emit('KelompokCreate')">
                    <i class="ri-add-line me-1">
                    </i>
                    Tambah Kelompok
                </button>
            </div>
        </div>
    </div>
    {{-- FILTER --}}
    <div class="card-body border-top border-bottom bg-light-subtle">
        <div class="row g-3 align-items-end">
            {{-- SEARCH --}}
            <div class="col-xxl-9 col-lg-8">
                <label class="form-label fw-semibold">
                    Pencarian Kelompok
                </label>
                <div class="search-box">
                    <input type="text" class="form-control rounded-3" wire:model.debounce.400ms="search"
                        placeholder="Cari nama kelompok, masjid, atau desa...">
                    <i class="ri-search-line search-icon">
                    </i>
                </div>
            </div>
            {{-- MASTER DESA --}}
            <div class="col-xxl-3 col-lg-4">
                <button type="button" class="btn btn-primary border w-100 rounded-pill" data-bs-toggle="modal"
                    data-bs-target="#ModalDesaCreate" wire:click="$emit('DesaCreate')">
                    <i class="ri-add-circle-line me-1">
                    </i>
                    Tambah Desa
                </button>
            </div>
        </div>
    </div>
    {{-- TABS --}}
    <div class="card-body">
        <div class="overflow-hidden">
            {{-- NAV TAB --}}
            <div class="px-3 pt-3">
                <ul class="nav nav-pills gap-2 flex-nowrap overflow-auto pb-3" role="tablist">
                    {{-- SEMUA --}}
                    <li class="nav-item flex-shrink-0">
                        <button type="button"
                            class="nav-link rounded-pill px-4 py-2 fw-medium {{ $activeTab === 'semua' ? 'active' : '' }}"
                            wire:click="setActiveTab('semua')">
                            <i class="ri-apps-2-line me-1">
                            </i>
                            Semua Kelompok
                        </button>
                    </li>
                    {{-- DESA --}} @foreach($desa as $item)
                    <li class="nav-item flex-shrink-0">
                        <button type="button"
                            class="nav-link rounded-pill px-4 py-2 fw-medium {{ $activeTab === 'desa-'.$item->ms_desa_id ? 'active' : '' }}"
                            wire:click="setActiveTab('desa-{{ $item->ms_desa_id }}')">
                            <i class="ri-map-pin-community-line me-1">
                            </i>
                            {{ $item->nama_desa }}
                        </button>
                    </li>
                    @endforeach
                </ul>
            </div>
            {{-- CONTENT --}}
            <div class="bg-white">
                <div class="tab-content">
                    {{-- SEMUA KELOMPOK --}}
                    <div class="tab-pane fade {{ $activeTab === 'semua' ? 'show active' : '' }}" id="tabAll" role="tabpanel">
                        @include('livewire.administrasi.kelompok.data', [ 'listKelompok' => $allKelompok])
                    </div>
                    {{-- PER DESA --}} 
                    @foreach($desa as $kat)
                    <div class="tab-pane fade {{ $activeTab === 'desa-'.$kat->ms_desa_id ? 'show active' : '' }}" id="tabDesa{{ $kat->ms_desa_id }}" role="tabpanel">
                        @php 
                            $kelompokDesa = $allKelompok->where( 'ms_desa_id', $kat->ms_desa_id);
                        @endphp
                        @include('livewire.administrasi.kelompok.data', [ 'listKelompok' => $kelompokDesa])
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>