<div wire:ignore.self class="modal fade" id="ModalDetailKegiatan" tabindex="-1"
    aria-labelledby="ModalDetailKegiatanLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="modal-header bg-light border-0 px-4 py-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title rounded-circle 
						{{ $kegiatan?->tipe_kegiatan === 'rutin' ? 'bg-success-subtle text-success' : 'bg-primary-subtle text-primary' }}">
                            @if($kegiatan?->tipe_kegiatan === 'rutin')
                            <i class="ri-repeat-line fs-18"></i>
                            @else
                            <i class="ri-calendar-event-line fs-18"></i>
                            @endif
                        </div>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold mb-1" id="ModalDetailKegiatanLabel">
                            Detail Kegiatan Generus
                        </h5>
                        <p class="text-muted fs-13 mb-0">
                            Informasi lengkap kegiatan, lokasi, dan akses presensi peserta.
                        </p>
                    </div>
                </div>
                <button type="button" class="btn btn-light btn-icon rounded-circle shadow-none" data-bs-dismiss="modal">
                    <i class="ri-close-line fs-18"></i>
                </button>
            </div>
            @if($kegiatan) {{-- BODY --}}
            <div class="modal-body p-4">
                {{-- HERO --}}
                <div class="card border-0 bg-light-subtle shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex flex-column flex-lg-row justify-content-between gap-4">
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge rounded-pill px-3 py-2
									{{ $kegiatan->tipe_kegiatan === 'rutin' ? 'bg-success-subtle text-success' : 'bg-primary-subtle text-primary' }}">
                                        @if($kegiatan->tipe_kegiatan === 'rutin')
                                            <i class="ri-repeat-line me-1"></i>Kegiatan Rutin 
                                        @else
                                            <i class="ri-calendar-event-line me-1"></i>Event Sekali 
                                        @endif
                                    </span>
                                    <span class="badge bg-dark-subtle text-dark rounded-pill px-3 py-2">
                                        {{ ucfirst($kegiatan->scope) }}
                                    </span>
                                </div>
                                <h3 class="fw-bold mb-2">
                                    {{ $kegiatan->nama_kegiatan }}
                                </h3>
                                @if($kegiatan->deskripsi)
                                <p class="text-muted mb-0 lh-lg">
                                    {{ $kegiatan->deskripsi }}
                                </p>
                                @endif
                            </div>
                            {{-- QUICK INFO --}}
                            <div class="d-flex flex-column gap-2">
                                <div class="d-flex align-items-center gap-2 text-muted">
                                    <i class="ri-time-line text-warning"></i>
                                    <span>
                                        Update:
                                        <strong class="text-body">
                                            {{ $kegiatan->updated_at?->format('d M Y') ?? '-' }}
                                        </strong>
                                    </span>
                                </div>
                                <div class="d-flex align-items-center gap-2 text-muted">
                                    <i class="ri-group-line text-success"></i>
                                    <span>
                                        Peserta:
                                        <strong class="text-body">
                                            {{ ucfirst($kegiatan->jenjang ?? 'Semua Jenjang') }}
                                        </strong>
                                    </span>
                                </div>
                                <div class="d-flex align-items-center gap-2 text-muted">
                                    <i class="ri-user-star-line text-primary"></i>
                                    <span>
                                        Target:
                                        <strong class="text-body">
                                            {{ $kegiatan->targetPeserta() ?? '-' }} Peserta
                                        </strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- DETAIL GRID --}}
                <div class="row g-4">
                    {{-- INFORMASI JADWAL --}}
                    <div class="col-lg-6">
                        <div class="card border shadow-sm rounded-4 h-100 mb-0">
                            <div class="card-header bg-white border-0 pb-0 px-4 pt-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-xs">
                                        <div class="avatar-title bg-warning-subtle text-warning rounded-circle">
                                            <i class="ri-calendar-check-line"></i>
                                        </div>
                                    </div>
                                    <h6 class="fw-bold mb-0">
                                        Jadwal Kegiatan
                                    </h6>
                                </div>
                            </div>
                            <div class="card-body px-4 pb-4">
                                <div class="vstack gap-3">
                                    {{-- Tanggal --}}
                                    <div class="border border-dashed rounded-4 p-3">
                                        <p class="text-muted mb-1 fs-13">
                                            Tanggal / Hari
                                        </p>
                                        <h6 class="mb-0 fw-semibold">
                                            @if($kegiatan->tipe_kegiatan === 'sekali') 
                                                {{ $kegiatan->tanggal ? \App\Http\Controllers\HelperController::formatTanggalIndonesia($kegiatan->tanggal, 'd F Y') : '-' }} 
                                                @else 
                                                    @if(!empty($kegiatan->hari_rutin_label)) Rutin : {{ $kegiatan->hari_rutin_label }} 
                                                @endif 
                                            @endif
                                        </h6>
                                    </div>
                                    {{-- Waktu --}}
                                    <div class="border border-dashed rounded-4 p-3">
                                        <p class="text-muted mb-1 fs-13">
                                            Waktu Pelaksanaan
                                        </p>
                                        <h6 class="mb-0 fw-semibold">
                                            {{ $kegiatan->waktu ?? '-' }}
                                        </h6>
                                    </div>
                                    {{-- Jenjang --}}
                                    <div class="border border-dashed rounded-4 p-3">
                                        <p class="text-muted mb-1 fs-13">
                                            Jenjang Peserta
                                        </p>
                                        <h6 class="mb-0 text-uppercase fw-bold">
                                            {{ ucfirst($kegiatan->jenjang ?? 'Semua') }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- LINGKUP & LOKASI --}}
                    <div class="col-lg-6">
                        <div class="card border shadow-sm rounded-4 h-100 mb-0">
                            <div class="card-header bg-white border-0 pb-0 px-4 pt-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-xs">
                                        <div class="avatar-title bg-danger-subtle text-danger rounded-circle">
                                            <i class="ri-map-pin-line"></i>
                                        </div>
                                    </div>
                                    <h6 class="fw-bold mb-0">
                                        Lokasi Kegiatan
                                    </h6>
                                </div>
                            </div>
                            <div class="card-body px-4 pb-4">
                                <div class="vstack gap-3">
                                    {{-- Lingkup --}}
                                    <div class="border border-dashed rounded-4 p-3">
                                        <p class="text-muted mb-1 fs-13">
                                            Lingkup Kegiatan
                                        </p>
                                        <h6 class="mb-0 fw-semibold">
                                            @if($kegiatan->scope === 'daerah') Daerah Solo Selatan
                                            @elseif($kegiatan->scope === 'desa') Desa {{ $kegiatan->ms_desa->nama_desa ?? '-' }}
                                            @elseif($kegiatan->scope === 'kelompok') Kelompok {{ $kegiatan->ms_kelompok->nama_kelompok ?? '-'}}
                                            <span class="text-muted fw-normal">
                                                (Desa {{ $kegiatan->ms_kelompok->ms_desa->nama_desa ?? '-' }})
                                            </span>
                                            @endif
                                        </h6>
                                    </div>
                                    {{-- Tempat --}}
                                    <div class="border border-dashed rounded-4 p-3">
                                        <p class="text-muted mb-1 fs-13">
                                            Tempat
                                        </p>
                                        <h6 class="mb-0 fw-semibold">
                                            {{ $kegiatan->lokasi_final['tempat'] ?? '-' }}
                                        </h6>
                                    </div>
                                    {{-- Alamat --}}
                                    <div class="border border-dashed rounded-4 p-3">
                                        <p class="text-muted mb-1 fs-13">
                                            Alamat
                                        </p>
                                        <h6 class="mb-0 fw-semibold lh-base">
                                            {{ $kegiatan->lokasi_final['alamat'] ?? '-' }}
                                        </h6>
                                    </div>
                                    {{-- Peta --}} @if($kegiatan->lokasi_final['peta'])
                                    <a href="{{ $kegiatan->lokasi_final['peta'] }}" target="_blank"
                                        class="btn btn-soft-primary rounded-pill">
                                        <i class="ri-map-2-line me-1"></i>
                                        Buka Google Maps
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- AKSI --}}
                    <div class="col-12">
                        <div class="card border shadow-sm rounded-4 mb-0">
                            <div class="card-header bg-white border-0 pb-0 px-4 pt-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-xs">
                                        <div class="avatar-title bg-info-subtle text-info rounded-circle">
                                            <i class="ri-links-line"></i>
                                        </div>
                                    </div>
                                    <h6 class="fw-bold mb-0">
                                        Akses & Dokumen
                                    </h6>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    {{-- Pengumuman --}}
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="border rounded-4 p-3 h-100">
                                            <div class="d-flex align-items-start gap-3">
                                                <div class="avatar-sm">
                                                    <div
                                                        class="avatar-title bg-success-subtle text-success rounded-circle">
                                                        <i class="mdi mdi-whatsapp fs-18"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="text-muted fs-13 mb-1">
                                                        Pengumuman
                                                    </p>
                                                    <a style="cursor: pointer" wire:click.prevent="kegiatanPengumuman({{ $kegiatan->ms_kegiatan_id }})" class="fw-semibold text-success">
                                                        Cetak Pengumuman
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Laporan --}}
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="border rounded-4 p-3 h-100">
                                            <div class="d-flex align-items-start gap-3">
                                                <div class="avatar-sm">
                                                    <div
                                                        class="avatar-title bg-danger-subtle text-danger rounded-circle">
                                                        <i class="mdi mdi-file-chart-outline fs-18"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="text-muted fs-13 mb-1">
                                                        Laporan
                                                    </p>
                                                    <a wire:click.prevent="$emit('KegiatanPengumuman', {{ $kegiatan->ms_kegiatan_id }})" class="fw-semibold text-danger">
                                                        Cetak Laporan
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Presensi Kartu --}}
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="border rounded-4 p-3 h-100">
                                            <div class="d-flex align-items-start gap-3">
                                                <div class="avatar-sm">
                                                    <div
                                                        class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                        <i class="mdi mdi-qrcode fs-18"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="text-muted fs-13 mb-1">
                                                        Presensi Kartu
                                                    </p>
                                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                                        <a href="{{ route('operasional.presensi-kegiatan-kartu', $kegiatan->token) }}" target="_blank" class="fw-semibold text-primary">
                                                            Buka Presensi
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-light btn-icon rounded-circle" onclick="copyToClipboard('{{ route('operasional.presensi-kegiatan-kartu', $kegiatan->token) }}')">
                                                            <i class="mdi mdi-content-copy"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Presensi Manual --}}
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="border rounded-4 p-3 h-100">
                                            <div class="d-flex align-items-start gap-3">
                                                <div class="avatar-sm">
                                                    <div
                                                        class="avatar-title bg-secondary-subtle text-secondary rounded-circle">
                                                        <i class="mdi mdi-account-edit-outline fs-18"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="text-muted fs-13 mb-1">
                                                        Presensi Manual
                                                    </p>
                                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                                        <a href="{{ route('operasional.presensi-kegiatan', $kegiatan->token) }}" target="_blank" class="fw-semibold text-secondary">
                                                            Buka Presensi
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-light btn-icon rounded-circle" onclick="copyToClipboard('{{ route('operasional.presensi-kegiatan', $kegiatan->token) }}')">
                                                            <i class="mdi mdi-content-copy"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif {{-- FOOTER --}}
            <div class="modal-footer border-0 px-4 pb-4 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="ri-close-line me-1"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
    <script>
        function copyToClipboard(text) {
			navigator.clipboard.writeText(text).then(() = >{
				if (window.alertify) {
					alertify.success('URL berhasil dicopy!');
				} else {
					alert('URL berhasil dicopy!');
				}
			}).
			catch(err = >{
				console.error('Gagal menyalin:', err);
				if (window.alertify) {
					alertify.error('Gagal menyalin URL');
				} else {
					alert('Gagal menyalin URL');
				}
			});
		}
    </script>
</div>