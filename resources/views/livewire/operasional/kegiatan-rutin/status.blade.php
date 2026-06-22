<div wire:ignore.self class="modal fade" id="KegiatanStatus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn btn-light btn-icon rounded-circle ms-auto" data-bs-dismiss="modal">
                    <i class="ri-close-line fs-18"></i>
                </button>
            </div>
            <div class="modal-body px-4 pb-5 pt-2 text-center">
                <div class="mb-4">
                    <div class="avatar-xl mx-auto">
                        <div class="avatar-title {{ $status === 'aktif' ? 'bg-success-subtle text-success' : 'bg-primary-subtle text-primary' }} rounded-circle">
                            @if($status === 'aktif')
                            <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="loop"
                                colors="primary:#16a34a,secondary:#16a34a" style="width:70px;height:70px">
                            </lord-icon>
                            @else
                            <lord-icon src="https://cdn.lordicon.com/sbnjyzil.json" trigger="loop"
                                colors="primary:#0d6efd,secondary:#0d6efd" style="width:70px;height:70px">
                            </lord-icon>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <span class="badge {{ $status === 'aktif' ? 'bg-success-subtle text-success' : 'bg-primary-subtle text-primary' }} px-3 py-2 rounded-pill mb-3">
                        {{ $status === 'aktif' ? 'Konfirmasi Penyelesaian' : 'Aktifkan Kembali Kegiatan' }}
                    </span>
                    <h3 class="fw-bold mb-2">
                        @if($status === 'aktif') Selesaikan Kegiatan? @else Aktifkan Kembali? @endif
                    </h3>
                    <p class="text-muted mb-0 lh-lg px-lg-4">
                        @if($status === 'aktif')
                        Kegiatan <strong>{{ $namaKegiatan }}</strong> akan ditutup dan operasional presensi maupun infaq tidak dapat diubah kembali.
                        @else
                        Kegiatan <strong>{{ $namaKegiatan }}</strong> akan dibuka kembali sehingga presensi dan infaq dapat dilanjutkan.
                        @endif
                    </p>
                </div>
                <div class="alert alert-light border rounded-4 text-start mt-4 mb-0">
                    <div class="d-flex align-items-start gap-3">
                        <div class="flex-shrink-0">
                            <i class="ri-error-warning-line text-warning fs-20"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Perhatian</h6>
                            <p class="text-muted mb-0 fs-13">
                                @if($status === 'aktif') Pastikan seluruh presensi dan infaq kegiatan telah diinput sebelum kegiatan diselesaikan.
                                @else Pengaktifan kembali kegiatan akan membuka akses operasional presensi dan infaq.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 px-4 pb-4 justify-content-center">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="ri-close-line me-1"></i>
                    Batal
                </button>
                <button type="button" class="btn {{ $status === 'aktif' ? 'btn-success' : 'btn-primary' }} rounded-pill px-4"
                    wire:click="updateStatus">
                    <i class="{{ $status === 'aktif' ? 'ri-checkbox-circle-line' : 'ri-refresh-line' }} me-1"></i>
                    {{ $status === 'aktif' ? 'Ya, Selesaikan' : 'Aktifkan Kembali' }}
                </button>
            </div>
        </div>
    </div>
</div>
