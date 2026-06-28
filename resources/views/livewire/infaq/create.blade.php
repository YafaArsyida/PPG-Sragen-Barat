<div class="modal fade" id="ModalInfaq" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="modal-header border-0 pb-0 p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-hand-coin-line"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Input Infaq</h5>
                        <small class="text-muted">Tambahkan nominal infaq kegiatan</small>
                    </div>
                </div>
                <button type="button" class="btn btn-light btn-icon rounded-circle" data-bs-dismiss="modal">
                    <i class="ri-close-line fs-18"></i>
                </button>
            </div>

            <div class="modal-body p-4">
                {{-- RIWAYAT INFAQ --}}
                <div class="card border-0 bg-light-subtle rounded-4 mb-4">

                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar-sm">
                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-22">
                                    <i class="ri-user-3-line">
                                    </i>
                                </div>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">
                                    {{ $nama_kegiatan ?? '-' }}
                                </h5>
                                <small>
                                    {{ $tanggal_kegiatan ? \App\Http\Controllers\HelperController::formatTanggalIndonesia($tanggal_kegiatan, 'd F Y') : '-' }}
                                </small>
                            </div>
                        </div>
                    </div>
                    @if(count($listInfaq))
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                Riwayat Infaq
                            </span>
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                Total Rp {{ number_format($listInfaq->sum('nominal'), 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="d-flex flex-column gap-2">
                            @foreach($listInfaq as $i => $infaq)
                            <div class="border rounded-4 p-3 bg-white">
                                <div class="d-flex justify-content-between align-items-start gap-3">
                                    <div class="d-flex align-items-start gap-2 flex-grow-1">
                                        <span class="fw-semibold text-muted" style="min-width: 22px;">
                                            {{ $i + 1 }}.
                                        </span>
                                        <div class="flex-grow-1">
                                            <div class="fw-semibold">
                                                {{ $infaq->tanggal
                                                    ? \App\Http\Controllers\HelperController::formatTanggalIndonesia($infaq->tanggal, 'd F Y')
                                                    : '-' }}
                                            </div>
                                            @if($infaq->keterangan)
                                            <div class="text-muted fs-13">
                                                {{ $infaq->keterangan }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="fw-bold text-primary">
                                            Rp {{ number_format($infaq->nominal, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                {{-- FORM INPUT --}}
                <form wire:submit.prevent="save">
                    <div class="card border rounded-4 shadow-sm mb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-2 mb-4">
                                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                                    Form Infaq Baru
                                </span>
                            </div>

                            <div class="row g-4">
                                {{-- TANGGAL --}}
                                <div class="col-lg-4">
                                    <label class="form-label fw-semibold">Tanggal</label>
                                    <input type="date" class="form-control" wire:model.defer="tanggal">
                                    @error('tanggal')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- NOMINAL --}}
                                <div class="col-lg-4">
                                    <label class="form-label fw-semibold">
                                        Nominal Infaq <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" wire:model.defer="nominal"
                                            placeholder="Masukkan nominal">
                                    </div>
                                    @error('nominal')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- KETERANGAN --}}
                                <div class="col-lg-4">
                                    <label class="form-label fw-semibold">Keterangan</label>
                                    <textarea class="form-control" rows="1" wire:model.defer="keterangan"
                                        placeholder="Catatan tambahan..."></textarea>
                                    @error('keterangan')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- FOOTER (di dalam form, supaya submit jalan) --}}
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                            <i class="ri-close-line me-1"></i> Tutup
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                            <i class="ri-save-3-line me-1"></i> Simpan Infaq
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>