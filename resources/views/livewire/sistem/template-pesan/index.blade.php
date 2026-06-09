<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body">
        <div class="alert alert-info border-0">
            <div class="d-flex">
                <i class="ri-information-line fs-18 me-2"></i>
                <div>
                    <h6 class="fw-semibold mb-2">
                        Placeholder Otomatis
                    </h6>
    
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="mb-0">
                                <li>{jenjang & scope}</li>
                                <li>{nama kegiatan}</li>
                                <li>{hari, tanggal}</li>
                                <li>{waktu}</li>
                            </ul>
                        </div>
    
                        <div class="col-md-6">
                            <ul class="mb-0">
                                <li>{lokasi}</li>
                                <li>{alamat}</li>
                                <li>{tautan peta}</li>
                            </ul>
                        </div>
                    </div>
    
                    <small class="text-muted">
                        Data di atas akan terisi otomatis dari kegiatan yang dipilih saat pengiriman pesan.
                    </small>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white p-4 pt-0" style="line-height:1.8;">
        <div style="white-space: pre-line;">
            <b>{{ $judul ?: 'belum disetting' }}</b> <span class="fw-bold text-primary">{judul}</span>

            Kepada:
            Remaja Desa Barat <span class="fw-bold text-primary">{jenjang & scope}</span>

            {{ $salam_pembuka ?: 'belum disetting' }} <span class="fw-bold text-primary">{salam pembuka}</span>
            {{ $kalimat_pembuka ?: 'belum disetting' }} <span class="fw-bold text-primary">{kalimat pembuka}</span>

            <b>Pengajian Remaja Desa Barat</b> <span class="fw-bold text-primary">{nama kegiatan}</span>
            <i>Selasa, 23 Oktober 2001</i> <span class="fw-bold text-primary">{hari, tanggal}</span>
            <b>19:30</b><span class="fw-bold text-primary"> {waktu}</span>
            <b>Masjid Roudhotul Jannah</b> <span class="fw-bold text-primary">{lokasi}</span>
            Jl. Porong, Pucangsawit, Surakarta <span class="fw-bold text-primary">{alamat}</span>
            
            https://maps.app.goo.gl/xxxx <span class="fw-bold text-primary">{tautan peta}</span>

            {{ $kalimat_penutup ?: 'belum disetting' }} <span class="fw-bold text-primary">{kalimat penutup}</span>

            {{ $salam_penutup ?: 'belum disetting' }} <span class="fw-bold text-primary">{salam penutup}</span>
        </div>

        <div class="text-end mt-3">
            <small class="text-muted">
                3:54
                <i class="ri-check-double-line text-success fs-14"></i>
            </small>
        </div>
    </div>
</div>