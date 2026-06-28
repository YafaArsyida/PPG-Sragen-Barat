<div class="card border-0 shadow-sm rounded-4 overflow-hidden" id="generusList">
    {{-- HEADER --}}
    <div class="card-header bg-white border-0 p-4">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4">
            {{-- TITLE --}}
            <div>
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-team-line">
                            </i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">
                            Administrasi Data Generasi Penerus
                        </h5>
                        <small>
                            Kelola data generus berdasarkan kelompok dan jenjang usia
                        </small>
                    </div>
                </div>
            </div>
            {{-- ACTION --}}
            <div class="d-flex gap-2 flex-wrap">
                {{-- IMPORT --}}
                <button type="button" class="btn btn-light border rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#ExportGenerus">
                    <i class="ri-database-2-line me-1 text-secondary"></i>
                    Export Data
                </button>
                {{-- IMPORT --}}
                <button type="button" class="btn btn-soft-primary border rounded-pill px-4" data-bs-toggle="modal"
                    data-bs-target="#ModalImportGenerus"
                    wire:click.prevent="$emit('showImportGenerus', {{ $selectedDesa }})">
                    <i class="ri-database-2-line me-1">
                    </i>
                    Import Generus
                </button>
                {{-- IMPORT KARTU --}}
                @if(Str::startsWith($activeTab, 'kelompok-'))
                    @php
                    $kelompokId = str_replace('kelompok-', '', $activeTab);
                    @endphp
                
                    <button type="button" class="btn btn-soft-primary border rounded-pill px-4" data-bs-toggle="modal"
                        data-bs-target="#ModalImportKartu" wire:click.prevent="$emit('showImportKartu', {{ $kelompokId }})">
                    
                        <i class="ri-bank-card-line me-1"></i>
                        Import Kartu
                    </button>
                @endif
                {{-- TAMBAH --}}
                <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal"
                    data-bs-target="#ModalGenerusCreate" wire:click="$emit('GenerusCreate')">
                    <i class="ri-add-line me-1">
                    </i>
                    Tambah Generus
                </button>
            </div>
        </div>
    </div>
    {{-- FILTER --}}
    <div class="card-body border-top bg-light-subtle">
        <div class="row g-3 align-items-end">
            {{-- SEARCH --}}
            <div class="col-xxl-5 col-lg-6">
                <label class="form-label fw-semibold">
                    Cari Nama Generus
                </label>
                <div class="search-box">
                    <input type="text" class="form-control rounded-3" wire:model.debounce.400ms="search"
                        placeholder="Ketik nama generus...">
                    <i class="ri-search-line search-icon">
                    </i>
                </div>
            </div>
            {{-- GENDER --}}
            <div class="col-xxl-2 col-lg-3 col-sm-6">
                <label class="form-label  fw-semibold">
                    Status Sambung
                </label>
                <select class="form-select" wire:model="status_generus">
                    <option value="sambung">
                        Sambung
                    </option>
                    <option value="pindah sambung">
                        Pindah Sambung
                    </option>
                    <option value="nonaktif">
                        Non-Aktif
                    </option>
                </select>
            </div>
            <div class="col-xxl-2 col-lg-3 col-sm-6">
                <label class="form-label  fw-semibold">
                    Gender
                </label>
                <select class="form-select" wire:model="gender">
                    <option value="">
                        Semua Generus
                    </option>
                    <option value="laki-laki">
                        Laki-laki
                    </option>
                    <option value="perempuan">
                        Perempuan
                    </option>
                </select>
            </div>
            {{-- JENJANG --}}
            <div class="col-xxl-3 col-lg-3 col-sm-6">
                <label class="form-label fw-semibold">
                    Jenjang Usia
                </label>
                <select class="form-select" wire:model="jenjangUsia">
                    <option value="">
                        Semua Jenjang
                    </option>
                    <option value="caberawit">
                        Caberawit (&lt; 12 Tahun)
                    </option>
                    <option value="remaja">
                        Remaja (12 – 30 Tahun)
                    </option>
                    <option value="gp">
                        GP (12 – 23 Tahun)
                    </option>
                    {{-- <option value="pra_nikah">
                        Pra Nikah (19 – 23 Tahun)
                    </option> --}}
                    <option value="mandiri">
                        Mandiri (&gt; 17 Tahun)
                    </option>
                </select>
            </div>
        </div>
    </div>
    {{-- CONTENT --}}
    <div class="card-body">
        <div class="overflow-hidden">
            {{-- TAB NAV --}}
            <div class="px-3">
                <ul class="nav nav-pills gap-2 flex-nowrap overflow-auto pb-3" role="tablist">
                    {{-- SEMUA --}}
                    <li class="nav-item flex-shrink-0">
                        <button type="button"
                            class="nav-link rounded-pill px-4 py-2 fw-medium {{ $activeTab === 'semua' ? 'active' : '' }}"
                            wire:click="setActiveTab('semua')">
                            <i class="ri-user-3-line me-1">
                            </i>
                            Semua Generus
                        </button>
                    </li>
                    {{-- DINAMIS KELOMPOK --}}
                    @foreach($kelompok as $item)
                    <li class="nav-item flex-shrink-0">
                        <button type="button"
                            class="nav-link rounded-pill px-4 py-2 fw-medium {{ $activeTab === 'kelompok-'.$item->ms_kelompok_id ? 'active' : '' }}"
                            wire:click="setActiveTab('kelompok-{{ $item->ms_kelompok_id }}')">
                            <i class="ri-group-2-line me-1">
                            </i>
                            {{ $item->nama_kelompok }}
                        </button>
                    </li>
                    @endforeach
                </ul>
            </div>
            {{-- TAB CONTENT --}}
            <div class="bg-white">
                <div class="tab-content">
                    {{-- SEMUA GENERUS --}}
                    <div class="tab-pane fade {{ $activeTab === 'semua' ? 'show active' : '' }}" id="tabSemua" role="tabpanel">
                        @include('livewire.administrasi.generus.data', ['listGenerus' => $allGenerus])
                    </div>
        
                    {{-- PER KELOMPOK --}}
                    @foreach($kelompok as $grp)
                    <div class="tab-pane fade {{ $activeTab === 'kelompok-'.$grp->ms_kelompok_id ? 'show active' : '' }}"
                        id="tabKelompok{{ $grp->ms_kelompok_id }}" role="tabpanel">
                        @include('livewire.administrasi.generus.data', ['listGenerus' => $allGenerus])
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL EXPORT --}}
    <div class="modal fade" id="ExportGenerus" tabindex="-1" aria-labelledby="exportRecordLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                {{-- HEADER --}}
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn btn-light btn-icon rounded-circle ms-auto" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ri-close-line fs-18"></i>
                    </button>
                </div>
    
                {{-- BODY --}}
                <div class="modal-body px-4 pb-5 pt-2 text-center">
                    {{-- ICON --}}
                    <div class="mb-4">
                        <div class="avatar-xl mx-auto">
                            <div class="avatar-title bg-success-subtle text-success rounded-circle">
                                <lord-icon src="https://cdn.lordicon.com/fjvfsqea.json" trigger="loop"
                                    colors="primary:#198754,secondary:#198754" style="width:70px;height:70px">
                                </lord-icon>
                            </div>
                        </div>
                    </div>
                    {{-- TITLE --}}
                    <div class="mb-2">
                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill mb-3">
                            Export Laporan
                        </span>
                        <h3 class="fw-bold mb-2" id="exportRecordLabel">
                            Export Data Generus?
                        </h3>
    
                        <p class="text-muted mb-0 lh-lg px-lg-4">
                            Laporan generus akan diekspor sesuai
                            filter dan data tabel yang sedang ditampilkan.
                        </p>
                    </div>
    
                    {{-- INFO --}}
                    <div class="alert alert-light border rounded-4 text-start mt-4 mb-0">
                        <div class="d-flex align-items-start gap-3">
                            <div class="flex-shrink-0">
                                <i class="ri-information-line text-primary fs-20"></i>
                            </div>
                            <div>
                                <h6 class="fw-semibold mb-1">
                                    Informasi Export
                                </h6>
    
                                <p class="text-muted mb-0 fs-13">
                                    File akan diunduh dalam format Excel (.xlsx)
                                    dan hanya mencakup data yang tampil pada tabel.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- FOOTER --}}
                <div class="modal-footer border-0 pt-0 px-4 pb-4 justify-content-center">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i>
                        Batal
                    </button>
    
                    <button type="button" class="btn btn-success rounded-pill px-4" id="konfirmasiExportLaporan"
                        data-bs-dismiss="modal">
                        <i class="ri-file-excel-2-line me-1"></i>
                        Ya, Export
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('konfirmasiExportLaporan').addEventListener('click', function () {
            alertify.success("Menyiapkan Dokumen");

            setTimeout(function () {
                var table = document.getElementById("DataGenerus");

                var data = [];
                // Kolom yang ingin diexport 
                var exportCols = [0,2,3,4,5,6,7,8];

                // Ambil header
                var headers = [];
                for(var i=0; i<exportCols.length; i++){
                    headers.push(table.tHead.rows[0].cells[exportCols[i]].innerText.trim());
                }
                data.push(headers);

                // Ambil data tbody
                for(var i=0; i<table.tBodies[0].rows.length; i++){
                    var row = table.tBodies[0].rows[i];
                    var rowData = [];
                    for(var j=0; j<exportCols.length; j++){
                        rowData.push(row.cells[exportCols[j]].innerText.trim());
                    }
                    data.push(rowData);
                }

                // Ambil data tfoot (jika ada)
                if(table.tFoot){
                    for(var i=0; i<table.tFoot.rows.length; i++){
                        var row = table.tFoot.rows[i];
                        var rowData = [];
                        for(var j=0; j<exportCols.length; j++){
                            rowData.push(row.cells[exportCols[j]].innerText.trim());
                        }
                        data.push(rowData);
                    }
                }

                // Buat workbook
                var wb = XLSX.utils.book_new();
                var ws = XLSX.utils.aoa_to_sheet(data);
                XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

                XLSX.writeFile(wb, "Data-Generus.xlsx");

            }, 1000);
        });
        
    </script>
</div>