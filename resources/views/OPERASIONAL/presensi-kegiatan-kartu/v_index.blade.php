<!doctype html>
<html lang="en" data-layout="semibox" data-sidebar-visibility="show" data-topbar="light" data-sidebar="light"
    data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>TemanGenerus | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sistem Administrasi Terintegrasi untuk Generus" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets')}}/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="{{asset('assets')}}/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('assets')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets')}}/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{asset('assets')}}/css/custom.min.css" rel="stylesheet" type="text/css" />

    <!-- alertifyjs Css -->
    <link href="{{asset('assets')}}/libs/alertifyjs/build/css/alertify.min.css" rel="stylesheet" type="text/css" />
    
    <!-- alertifyjs default themes  Css -->
    <link href="{{asset('assets')}}/libs/alertifyjs/build/css/themes/default.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="smartpass-attendance min-vh-100 bg-light d-flex flex-column">
        <header class="border-bottom bg-white">
            <div class="container-fluid px-4 px-xl-5">
                <div class="d-flex align-items-center justify-content-between" style="height: 72px;">

                    {{-- BRAND --}}
                    <div class="d-flex align-items-center gap-3">

                        <div class="avatar-sm">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-3 fs-4">
                                <i class="ri-rfid-line"></i>
                            </div>
                        </div>

                        <div>
                            <h5 class="mb-0 fw-semibold text-dark">
                                TemanGenerus
                            </h5>

                            <small class="text-muted">
                                SmartPass {{ config('app.name') }}
                            </small>
                        </div>

                    </div>

                    {{-- HEADER INFO --}}
                    <div class="d-flex align-items-center gap-4">

                        {{-- TANGGAL --}}
                        <div class="text-end d-none d-md-block">
                            <div class="fw-semibold text-dark">
                                {{ now()->locale('id')->translatedFormat('l, d F Y') }}
                            </div>

                            <small class="text-muted">
                                Operasional Presensi
                            </small>
                        </div>

                        <div class="vr d-none d-md-block"></div>

                        {{-- JAM --}}
                        <div class="text-end">
                            <div id="realtime-clock" class="fw-bold text-dark fs-5">
                                --:--:--
                            </div>

                            <small class="text-muted">
                                WIB
                            </small>
                        </div>

                        {{-- FULLSCREEN --}}
                        <div class="vr"></div>

                        <div class="header-item">
                            <button
                                type="button"
                                id="btn-fullscreen"
                                class="btn btn-icon btn-topbar rounded-circle shadow-none"
                                data-toggle="fullscreen"
                                title="Layar penuh"
                            >
                                <i class="bx bx-fullscreen fs-22"></i>
                            </button>
                        </div>

                    </div>

                </div>
            </div>
        </header>

        <main class="flex-grow-1">
            <div class="container-fluid px-3 px-xl-5 py-4">
                {{-- dari sini --}}
                <div class="row g-4">
                    {{-- =================================================
                        LEFT : PRESENSI OPERASIONAL
                    ================================================== --}}
                    <div class="col-lg-8">
                        <div class="h-100">
                            {{-- PAGE TITLE --}}
                            <div class="mb-4">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                                        <i class="ri-checkbox-circle-line me-1"></i>
                                        Kegiatan Remaja
                                    </span>

                                </div>

                                <h3 class="fw-semibold mb-1">
                                    PPG Solo Selatan
                                </h3>

                                <p class="text-muted mb-0">
                                    <i class="ri-map-pin-line me-1"></i>
                                     Perumnas Gemolong Permai Jl. Melati No.RT 9, Dusun 2, Gemolong, Kec. Gemolong, Kabupaten Sragen, Jawa Tengah 50274 
                                </p>
                            </div>

                            {{-- =================================================
                                STATUS PRESENSI
                            ================================================== --}}
                            <div class="mb-4">
                                <div class="row g-3">
                                    {{-- HADIR --}}
                                    <div class="col-md-4">
                                        <div class="card border shadow-none rounded-4 mb-0 h-100">
                                            <div class="card-body p-4">
                                                <div class="d-flex align-items-center justify-content-between">

                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="avatar-md flex-shrink-0">
                                                            <div class="avatar-title bg-light text-success rounded-circle fs-4">
                                                                <i class="ri-checkbox-circle-line"></i>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <div class="text-muted small mb-1">
                                                                STATUS
                                                            </div>
                                                            <div class="fs-5 fw-semibold text-dark">
                                                                Hadir
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <div class="fs-3 fw-bold text-dark">
                                                            128
                                                        </div>
                                                        <div class="text-muted small">
                                                            Generus
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- IZIN --}}
                                    <div class="col-md-4">
                                        <div class="card border shadow-none rounded-4 mb-0 h-100">
                                            <div class="card-body p-4">
                                                <div class="d-flex align-items-center justify-content-between">

                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="avatar-md flex-shrink-0">
                                                            <div class="avatar-title bg-light text-primary rounded-circle fs-4">
                                                                <i class="ri-time-line"></i>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <div class="text-muted small mb-1">
                                                                STATUS
                                                            </div>
                                                            <div class="fs-5 fw-semibold text-dark">
                                                                Izin
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <div class="fs-3 fw-bold text-dark">
                                                            12
                                                        </div>
                                                        <div class="text-muted small">
                                                            Generus
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ALFA --}}
                                    <div class="col-md-4">
                                        <div class="card border shadow-none rounded-4 mb-0 h-100">
                                            <div class="card-body p-4">
                                                <div class="d-flex align-items-center justify-content-between">

                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="avatar-md flex-shrink-0">
                                                            <div class="avatar-title bg-light text-secondary rounded-circle fs-4">
                                                                <i class="ri-close-circle-line"></i>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <div class="text-muted small mb-1">
                                                                STATUS
                                                            </div>
                                                            <div class="fs-5 fw-semibold text-dark">
                                                                Alfa
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <div class="fs-3 fw-bold text-dark">
                                                            5
                                                        </div>
                                                        <div class="text-muted small">
                                                            Generus
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            {{-- =================================================
                                Generus berhasil TAP
                            ================================================== --}}
                            <div class="card border shadow-none rounded-4">
                                <div class="card-body p-4 p-xl-5">

                                    {{-- HEADER --}}
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div>
                                            <h5 class="fw-semibold mb-1">
                                                Verifikasi Berhasil
                                            </h5>
                                            <p class="text-muted mb-0">
                                                Kartu generus berhasil diverifikasi dan presensi tercatat
                                            </p>
                                        </div>

                                        <div class="text-muted">
                                            <i class="ri-checkbox-circle-line fs-5"></i>
                                        </div>
                                    </div>

                                    {{-- IDENTITY --}}
                                    <div class="border rounded-4 p-4">

                                        <div class="d-flex align-items-center gap-4">

                                            {{-- FOTO --}}
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xl">
                                                    <div class="avatar-title rounded-circle bg-light text-primary fs-2 fw-semibold">
                                                        YA
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- DATA --}}
                                            <div class="flex-grow-1">

                                                {{-- NAMA + STATUS --}}
                                                <div class="d-flex align-items-center justify-content-between gap-3 mb-1">
                                                    <div>
                                                        <h3 class="fw-bold mb-1">
                                                            Yafa Arsyida
                                                        </h3>

                                                        <div class="text-muted">
                                                            Kelompok Baron
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <div class="fs-4 fw-bold text-dark">
                                                            08:02
                                                        </div>

                                                        <small class="text-muted">
                                                            Hadir
                                                        </small>
                                                    </div>
                                                </div>

                                                <hr class="my-4">

                                                {{-- DETAIL --}}
                                                <div class="row g-3">

                                                    <div class="col-sm-6 col-lg-4">
                                                        <div class="text-muted small mb-1">
                                                            Generus ID
                                                        </div>

                                                        <div class="fw-semibold">
                                                            GENZ-019282829
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-lg-4">
                                                        <div class="text-muted small mb-1">
                                                            Nomor Kartu
                                                        </div>

                                                        <div class="fw-semibold">
                                                            0000123456
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-lg-4">
                                                        <div class="text-muted small mb-1">
                                                            Verifikasi
                                                        </div>

                                                        <div class="fw-semibold text-success">
                                                            <i class="ri-checkbox-circle-line me-1"></i>
                                                            SmartCard
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- =================================================
                                NOMOR KARTU
                            ================================================== --}}
                            <div class="card border shadow-none rounded-4 mb-4">
                                <div class="card-body p-4 p-xl-5">

                                    <label class="form-label fw-semibold text-dark mb-2">
                                        Nomor Kartu
                                    </label>

                                    <div class="position-relative">

                                        <div class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                                            <i class="ri-bank-card-line fs-4"></i>
                                        </div>

                                        <input
                                            type="text"
                                            inputmode="none"
                                            autocomplete="off"
                                            class="form-control form-control-lg rounded-3 ps-5 py-3 fs-4 fw-semibold text-center"
                                            placeholder="Tap kartu generus..."
                                            {{-- wire:model.defer="nomorKartu" --}}
                                            autofocus
                                        >

                                    </div>

                                    <div class="text-center mt-3">
                                        <small class="text-muted">
                                            <i class="ri-information-line me-1"></i>
                                            Tempelkan kartu pada reader presensi
                                        </small>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- =================================================
                        RIGHT : HISTORY
                    ================================================== --}}
                    <div class="col-lg-4">
                        <div class="card border shadow-none rounded-4 h-100">
                            {{-- HEADER --}}
                            <div class="card-header bg-transparent border-bottom px-4 py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-warning-subtle text-warning rounded-circle fs-18">
                                            <i class="ri-trophy-line">
                                            </i>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="modal-title fw-bold">
                                            Ranking Kehadiran
                                        </h5>
                                        <small>
                                            Generus dengan kehadiran terbaik
                                        </small>
                                    </div>

                                </div>
                            </div>

                            {{-- RANKING --}}
                            <div class="card-body p-0">

                                {{-- RANK 1 --}}
                                <div class="px-4 py-3 border-bottom">
                                    <div class="d-flex align-items-center gap-3">

                                        {{-- MEDAL --}}
                                        <div class="avatar-sm flex-shrink-0">
                                            <div class="avatar-title bg-warning text-white rounded-circle">
                                                <i class="ri-medal-fill fs-5"></i>
                                            </div>
                                        </div>

                                        {{-- GENERUS --}}
                                        <div class="flex-grow-1 min-width-0">
                                            <div class="fw-semibold text-body text-truncate">
                                                Ahmad Fauzan
                                            </div>

                                            <small class="text-muted">
                                                Kelompok Al-Hikmah
                                            </small>
                                        </div>

                                        {{-- JAM --}}
                                        <div class="text-end">
                                            <div class="fw-bold fs-5 text-dark">
                                                06:42
                                            </div>

                                            <small class="text-muted">
                                                Kartu
                                            </small>
                                        </div>

                                    </div>
                                </div>

                                {{-- RANK 2 --}}
                                <div class="px-4 py-3 border-bottom">
                                    <div class="d-flex align-items-center gap-3">

                                        {{-- AWARD --}}
                                        <div class="avatar-sm flex-shrink-0">
                                            <div class="avatar-title bg-secondary text-white rounded-circle">
                                                <i class="ri-award-fill fs-5"></i>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 min-width-0">
                                            <div class="fw-semibold text-body text-truncate">
                                                Budi Santoso
                                            </div>

                                            <small class="text-muted">
                                                Kelompok Al-Falah
                                            </small>
                                        </div>

                                        <div class="text-end">
                                            <div class="fw-bold fs-5 text-dark">
                                                06:48
                                            </div>

                                            <small class="text-muted">
                                                Manual
                                            </small>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            {{-- FOOTER --}}
                            <div class="card-footer bg-transparent border-top px-4 py-3">
                                <div class="d-flex align-items-center justify-content-between">

                                    <small class="text-muted">
                                        Urutan berdasarkan waktu hadir
                                    </small>

                                    <i class="ri-arrow-up-line text-muted"></i>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </main>

        <footer class="border-top bg-white">
            <div class="container-fluid px-4 px-xl-5">
                <div class="d-flex align-items-center justify-content-between py-3">
                    <small class="text-muted">
                        <script>document.write(new Date().getFullYear())</script> Crafted with <i class="mdi mdi-heart text-danger"></i>
                    </small>

                    <small class="text-muted">
                        Design & Develop by TemanGenerus
                    </small>
                </div>
            </div>
        </footer>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const button = document.getElementById('btn-fullscreen');
            const icon = document.getElementById('fullscreen-icon');

            if (!button) return;

            button.addEventListener('click', function () {

                if (!document.fullscreenElement) {

                    document.documentElement.requestFullscreen()
                        .then(() => {
                            icon.classList.remove('bx-fullscreen');
                            icon.classList.add('bx-exit-fullscreen');

                            button.setAttribute('title', 'Keluar dari layar penuh');
                        })
                        .catch((error) => {
                            console.error('Fullscreen gagal:', error);
                        });

                } else {

                    document.exitFullscreen();

                }

            });

            document.addEventListener('fullscreenchange', function () {

                if (document.fullscreenElement) {

                    icon.classList.remove('bx-fullscreen');
                    icon.classList.add('bx-exit-fullscreen');

                    button.setAttribute('title', 'Keluar dari layar penuh');

                } else {

                    icon.classList.remove('bx-exit-fullscreen');
                    icon.classList.add('bx-fullscreen');

                    button.setAttribute('title', 'Layar penuh');

                }

            });

        });
    </script>
    <!-- JAVASCRIPT -->
    <script src="{{asset('assets')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('assets')}}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{asset('assets')}}/libs/node-waves/waves.min.js"></script>
    <script src="{{asset('assets')}}/libs/feather-icons/feather.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="{{asset('assets')}}/js/plugins.js"></script>
    <!-- alertifyjs js -->
    <script src="{{asset('assets')}}/libs/alertifyjs/build/alertify.min.js"></script>
    <!-- validation init -->
    <script src="{{asset('assets')}}/js/pages/form-validation.init.js"></script>
    <!-- password create init -->
    <script src="{{asset('assets')}}/js/pages/passowrd-create.init.js"></script>
    @livewireScripts
    <script>
        // notif
        window.addEventListener('alertify-success', event => {
            alertify.set('notifier', 'position', 'bottom-right');
            alertify.success(event.detail.message);
        });

        window.addEventListener('alertify-error', event => {
            alertify.set('notifier', 'position', 'bottom-right');
            alertify.error(event.detail.message);
        });
        // end notif

        // modal
        window.addEventListener('hide-create-modal', (event) => {
            let modalId = event.detail.modalId;
            let modal = document.getElementById(modalId);
            if (modal) {
                let bootstrapModal = bootstrap.Modal.getInstance(modal);
                if (bootstrapModal) {
                    bootstrapModal.hide();
                }
            }
        });
        window.addEventListener('hide-edit-modal', (event) => {
            let modalId = event.detail.modalId;
            let modal = document.getElementById(modalId);
            if (modal) {
                let bootstrapModal = bootstrap.Modal.getInstance(modal);
                if (bootstrapModal) {
                    bootstrapModal.hide();
                }
            }
        });
        window.addEventListener('hide-delete-modal', (event) => {
            let modalId = event.detail.modalId;
            let modal = document.getElementById(modalId);
            if (modal) {
                let bootstrapModal = bootstrap.Modal.getInstance(modal);
                if (bootstrapModal) {
                    bootstrapModal.hide();
                }
            }
        });
        window.addEventListener('hide-modal', (event) => {
            let modalId = event.detail.modalId;
            let modal = document.getElementById(modalId);
            if (modal) {
                let bootstrapModal = bootstrap.Modal.getInstance(modal);
                if (bootstrapModal) {
                    bootstrapModal.hide();
                }
            }
        });
        // modal
        Livewire.on('openNewTab', (url) => {
            setTimeout(function() {
                window.open(url, '_blank');
            }, 1000);
        });

        function updateClock() {
            const now = new Date();

            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            document.getElementById('realtime-clock').textContent =
                `${hours}:${minutes}:${seconds}`;
        }

        updateClock();
        setInterval(updateClock, 1000);
    
    </script>
</body>

</html>