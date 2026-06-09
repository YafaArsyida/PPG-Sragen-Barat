<div class="card">
    {{-- HEADER --}}
    <div class="card-header border-0 pb-0">
        <div class="d-flex align-items-center gap-3">
            <div class="avatar-sm">
                <div class="avatar-title bg-success-subtle text-success rounded-circle fs-20">
                    <i class="ri-whatsapp-line"></i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1">
                    Template Pesan Generus
                </h5>
                <small class="text-muted">
                    Pengaturan format pesan WhatsApp untuk kegiatan Generus
                </small>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="save">
        <div class="card-body">
            {{-- PEMBUKA --}}
            <div class="mb-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                        Pembuka Pesan
                    </span>
                </div>

                <div class="row g-4">
                    <div class="col-lg-12">
                        <label class="form-label fw-semibold">
                            Judul Pesan
                            <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" wire:model.defer="judul" placeholder="Contoh : UNDANGAN KEGIATAN GENERUS">

                        @error('judul')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-lg-12">
                        <label class="form-label fw-semibold">
                            Salam Pembuka
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" wire:model.defer="salam_pembuka" placeholder="Assalamu'alaikum Wr. Wb.">
                        @error('salam_pembuka')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-lg-12">
                        <label class="form-label fw-semibold">
                            Kalimat Pembuka
                            <span class="text-danger">*</span>
                        </label>

                        <textarea rows="2" class="form-control" wire:model.defer="kalimat_pembuka" placeholder="Mengharap kehadiran Saudara/Saudari pada kegiatan berikut"></textarea>

                        @error('kalimat_pembuka')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- PENUTUP --}}
            <div class="mb-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                        Penutup Pesan
                    </span>
                </div>

                <div class="row g-4">
                    <div class="col-lg-12">
                        <label class="form-label fw-semibold">
                            Kalimat Penutup
                            <span class="text-danger">*</span>
                        </label>

                        <textarea rows="5" class="form-control" wire:model.defer="kalimat_penutup" placeholder="Kami berharap seluruh peserta dapat hadir tepat waktu..."></textarea>

                        @error('kalimat_penutup')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-lg-12">
                        <label class="form-label fw-semibold">
                            Salam Penutup
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" wire:model.defer="salam_penutup" placeholder="Wassalamu'alaikum Wr. Wb.">

                        @error('salam_penutup')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="card-footer bg-white text-end">

            {{-- <button type="button" class="btn btn-light rounded-pill px-4">
                <i class="ri-refresh-line me-1"></i>
                Reset
            </button> --}}

            <button type="submit" class="btn btn-primary rounded-pill px-4">
                <i class="ri-save-3-line me-1"></i>
                {{ $isEdit ? 'Perbarui Template' : 'Simpan Template' }}
            </button>

        </div>
    </form>
</div>