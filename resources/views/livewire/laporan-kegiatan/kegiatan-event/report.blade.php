<div wire:ignore.self class="offcanvas offcanvas-top border-0" id="offcanvasLaporanEvent"
    aria-labelledby="offcanvasLaporanEventLabel" style="min-height:100vh; background:#f8fafc;">
    {{-- HEADER --}}
    <div class="offcanvas-header border-bottom bg-white px-4 py-3 shadow-sm">
        <div class="d-flex align-items-center gap-3">
            <div class="avatar-sm">
                <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-18">
                    <i class="ri-file-chart-line">
                    </i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1">
                    Kegiatan Generus Desa {{ $nama_desa }}
                </h5>
                <small>
                    Rekap kehadiran, izin, dan alfa peserta kegiatan generus
                </small>
            </div>
        </div>
        <button type="button" class="btn btn-light btn-icon rounded-circle shadow-none" data-bs-dismiss="offcanvas">
            <i class="ri-close-line fs-18">
            </i>
        </button>
    </div>
    {{-- BODY --}}
    <div class="offcanvas-body">
        @if($kegiatan)
        <div class="row g-4">
            <div class="col-xxl-12 col-lg-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body">
                        {{-- HEADER --}}
                        <div class="text-center mb-2">
                            <h5 class="fw-bold mb-1 text-uppercase">
                                {{ $kegiatan->nama_kegiatan }}
                            </h5>
                            <small class="text-muted">
                                {{ $kegiatan->lokasi_final['tempat'] ?? '-' }} {{-- {{ $kegiatan->alamat
                                }} --}}
                            </small>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center">
                                <thead class="table-light">
                                    <tr class="text-uppercase fw-bold">
                                        <th rowspan="2">
                                            NO
                                        </th>
                                        <th rowspan="2">
                                            KELOMPOK
                                        </th>
                                        <th colspan="3">
                                            JUMLAH JAMAAH
                                        </th>
                                        <th colspan="5">
                                            KEHADIRAN {{ strtoupper(
                                            \App\Http\Controllers\HelperController::formatTanggalIndonesia(
                                            $kegiatan->tanggal, 'd F Y' ) ) }}
                                        </th>
                                    </tr>
                                    <tr class="text-uppercase fw-semibold">
                                        <th>Putra</th>
                                        <th>Putri</th>
                                        <th>Jumlah</th>
                                        <th>Putra</th>
                                        <th>Putri</th>
                                        <th>Jumlah</th>
                                        <th>%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($laporanRows as $row)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-start fw-semibold">
                                            {{ strtoupper($row['kelompok']) }}
                                        </td>
                                        <td>
                                            {{ $row['target_l'] }}
                                        </td>
                                        <td>
                                            {{ $row['target_p'] }}
                                        </td>
                                        <td class="fw-bold">
                                            {{ $row['target_total'] }}
                                        </td>
                                        <td>
                                            {{ $row['hadir_l'] }}
                                        </td>
                                        <td>
                                            {{ $row['hadir_p'] }}
                                        </td>
                                        <td class="fw-bold">
                                            {{ $row['hadir_total'] }}
                                        </td>
                                        <td class="fw-bold">
                                            {{ $row['presentase'] }}%
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                {{-- FOOTER --}}
                                <tfoot class="table-light fw-bold">
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            JUMLAH
                                        </td>
                                        <td>
                                            {{ $grandTotal['target_l'] }}
                                        </td>
                                        <td>
                                            {{ $grandTotal['target_p'] }}
                                        </td>
                                        <td>
                                            {{ $grandTotal['target_total'] }}
                                        </td>
                                        <td>
                                            {{ $grandTotal['hadir_l'] }}
                                        </td>
                                        <td>
                                            {{ $grandTotal['hadir_p'] }}
                                        </td>
                                        <td>
                                            {{ $grandTotal['hadir_total'] }}
                                        </td>
                                        <td>
                                            {{ $grandTotal['target_total'] > 0 ? round(($grandTotal['hadir_total']
                                            / $grandTotal['target_total']) * 100) : 0 }}%
                                        </td>
                                    </tr>
                                    <tr class="table-warning">
                                        <td colspan="2" class="text-center">
                                            <i class="ri-money-dollar-circle-line me-1"></i>
                                            INFAQ
                                        </td>
                                        <td colspan="7" class="fw-bold">
                                            RP {{ number_format($totalInfaq, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        {{-- CONTENT --}}
        <div class="row g-4">
            {{-- PRESENSI --}}
            <div class="col-xxl-12 col-lg-12">
                @livewire('laporan-kegiatan.kegiatan-event.attendance', [ 'kegiatanId' => $kegiatanId ])
            </div>
        </div>
        @endif
    </div>
</div>
 {{-- MODAL EXPORT --}}
<div class="modal fade" id="attendanceEvent" tabindex="-1" aria-labelledby="exportRecordLabel" aria-hidden="true" wire:ignore.self>
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
                        Export Kehadiran
                    </span>
                    <h3 class="fw-bold mb-2" id="exportRecordLabel">
                        Export Data Kehadiran?
                    </h3>

                    <p class="text-muted mb-0 lh-lg px-lg-4">
                        Laporan kehadiran generus akan diekspor sesuai
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

                <button type="button" class="btn btn-success rounded-pill px-4" id="konfirmasiAttendanceEvent"
                    data-bs-dismiss="modal">
                    <i class="ri-file-excel-2-line me-1"></i>
                    Ya, Export
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('konfirmasiAttendanceEvent').addEventListener('click', function () {
        alertify.success("Menyiapkan Dokumen");

        setTimeout(function () {
            var table = document.getElementById("Attendance");

            var data = [];
            // Kolom yang ingin diexport 
            var exportCols = [0,1,2,3,4,5];

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

            XLSX.writeFile(wb, "Laporan-Kehadiran-Generus.xlsx");

        }, 1000);
    });
</script>