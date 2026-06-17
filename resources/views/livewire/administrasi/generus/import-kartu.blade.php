<div wire:ignore.self class="modal fade" id="ModalImportKartu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
            <!-- HEADER -->
            <div class="modal-header border-0 pb-0 p-4">
                <div>
                    <h5 class="fw-bold mb-1">
                        Import Kartu Generus
                    </h5>
                    <small class="text-muted">
                        Perbarui nomor kartu RFID generus menggunakan dokumen Excel.
                    </small>
                </div>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body px-4 py-4">
                <!-- HERO -->
                <div class="text-center mb-4">
                    <div class="avatar-xl mx-auto mb-3">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                            <lord-icon src="https://cdn.lordicon.com/fjvfsqea.json" trigger="loop"
                                colors="primary:#405189,secondary:#0ab39c" style="width:70px;height:70px">
                            </lord-icon>
                        </div>
                    </div>
                    <h4 class="fw-bold mb-2">
                        Pembaruan Kartu Generus
                    </h4>
                    <p class="text-muted mb-0">
                        Download template data generus, isi nomor kartu RFID, lalu upload kembali
                        untuk memperbarui data.
                    </p>
                </div>
                <div class="row g-4">
                    <!-- PETUNJUK -->
                    <div class="col-lg-5">
                        <div class="card border shadow-sm h-100 mb-0">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0">
                                    Langkah Pembaruan
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-column gap-3">
                                    <div class="d-flex">
                                        <span class="badge bg-primary me-3">
                                            1
                                        </span>
                                        <div>
                                            Download template data generus.
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <span class="badge bg-primary me-3">
                                            2
                                        </span>
                                        <div>
                                            Isi atau perbarui kolom
                                            <strong>
                                                nomor_kartu
                                            </strong>
                                            .
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <span class="badge bg-primary me-3">
                                            3
                                        </span>
                                        <div>
                                            Jangan mengubah
                                            <strong>
                                                ms_generus_id
                                            </strong>
                                            .
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <span class="badge bg-primary me-3">
                                            4
                                        </span>
                                        <div>
                                            Upload kembali file Excel.
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <span class="badge bg-primary me-3">
                                            5
                                        </span>
                                        <div>
                                            Periksa perubahan sebelum disimpan.
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-grid">
                                    <button type="button" class="btn btn-success" wire:click="exportKartuGenerus">
                                        <i class="ri-file-excel-2-line me-1"></i>
                                        Download Template
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- UPLOAD -->
                    <div class="col-lg-7">
                        <div class="card border shadow-sm mb-0">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0">
                                    Upload Dokumen Pembaruan
                                </h6>
                            </div>
                            <div class="card-body">
                                <label class="form-label fw-semibold">
                                    File Excel
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <input type="file" wire:model="file_import" id="file_import" class="form-control">
                                @error('file_import')
                                <span class="text-danger small">
                                    {{ $message }}
                                </span>
                                @enderror
                                <div class="form-text">
                                    Format yang didukung: .xlsx, .xls
                                </div>
                                <div wire:loading wire:target="file_import" class="mt-2 text-primary">
                                    <div class="spinner-border spinner-border-sm me-1"></div>
                                    Membaca file Excel...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PREVIEW -->
                <div class="mt-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h5 class="fw-semibold mb-1">
                                Preview Perubahan
                            </h5>
                            <small class="text-muted">
                                Periksa perubahan nomor kartu sebelum disimpan.
                            </small>
                        </div>
                        @if(!empty($newGenerusList))
                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                            {{ count($newGenerusList) }} Data
                        </span>
                        @endif
                    </div>
                    <div class="table-responsive border rounded-3">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Generus</th>
                                    <th>Nomor Kartu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($newGenerusList))
                                    @foreach($newGenerusList as $row)
                                    <tr>
                                        <td>
                                            {{ $row['ms_generus_id'] ?? '-' }}
                                        </td>
                                        <td>
                                            {{ $row['nama_generus'] ?? '-' }}
                                        </td>
                                        <td>
                                            {{ $row['nomor_kartu'] ?? '-' }}
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">Belum ada data baru yang diimpor.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- FOOTER -->
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-link link-success shadow-none fw-medium" data-bs-dismiss="modal">
                    <i class="ri-close-line me-1 align-middle"></i> Tutup</a>
                <button class="btn btn-primary" wire:click="saveChanges">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>
