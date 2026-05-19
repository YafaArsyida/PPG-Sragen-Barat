<div wire:ignore.self class="modal fade" id="DapukanCreate" tabindex="-1" aria-labelledby="DapukanCreateLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-shield-user-line">
                            </i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1" id="DapukanCreateLabel">
                            Tambah Dapukan
                        </h5>
                        <small>
                            Tambahkan data dapukan pengurus
                        </small>
                    </div>
                </div>
                <button type="button" class="btn btn-light btn-icon rounded-circle" data-bs-dismiss="modal">
                    <i class="ri-close-line fs-18">
                    </i>
                </button>
            </div>
            <form wire:submit.prevent="save">
                <div class="modal-body p-4">
                    {{-- INFORMASI --}}
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                Informasi Dapukan
                            </span>
                        </div>
                        <div class="row g-4">
                            {{-- NAMA --}}
                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">
                                    Nama Dapukan
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <input type="text" wire:model.defer="nama_dapukan" class="form-control"
                                    placeholder="Contoh : Ketua Pengurus">
                                @error('nama_dapukan')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            {{-- DESKRIPSI --}}
                            <div class="col-lg-12">
                                <label class="form-label fw-semibold">
                                    Deskripsi
                                </label>
                                <textarea wire:model.defer="deskripsi" class="form-control" rows="4"
                                    placeholder="Tambahkan deskripsi dapukan"></textarea>
                                @error('deskripsi')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                {{-- FOOTER --}}
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1">
                        </i>
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="ri-save-3-line me-1">
                        </i>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>