<div class="modal fade" id="ModalInfaqEdit" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="modal-header border-0 pb-0 p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-money-dollar-circle-line">
                            </i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">
                            Edit Infaq
                        </h5>
                        <small>
                            Perbarui nominal infaq kegiatan
                        </small>
                    </div>
                </div>
                <button type="button" class="btn btn-light btn-icon rounded-circle" data-bs-dismiss="modal">
                    <i class="ri-close-line fs-18">
                    </i>
                </button>
            </div>
            <form wire:submit.prevent="update">
                <div class="modal-body p-4">
                    {{-- KEGIATAN --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Kegiatan
                        </label>
                        <input type="text" class="form-control bg-light" value="{{ $nama_kegiatan }}" readonly>
                    </div>
                    {{-- NOMINAL --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Nominal Infaq
                            <span class="text-danger">
                                *
                            </span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                Rp
                            </span>
                            <input type="number" class="form-control" wire:model.defer="nominal"
                                placeholder="Masukkan nominal">
                        </div>
                        @error('nominal')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    {{-- TANGGAL --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Tanggal
                        </label>
                        <input type="date" class="form-control" wire:model.defer="tanggal">
                        @error('tanggal')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    {{-- KETERANGAN --}}
                    <div>
                        <label class="form-label fw-semibold">
                            Keterangan
                        </label>
                        <textarea class="form-control" rows="3" wire:model.defer="keterangan"
                            placeholder="Tambahkan catatan..."></textarea>
                        @error('keterangan')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                </div>
                {{-- FOOTER --}}
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1">
                        </i>
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="ri-save-3-line me-1">
                        </i>
                        Update Infaq
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>