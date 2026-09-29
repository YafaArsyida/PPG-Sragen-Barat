<!doctype html>
<html lang="en" data-layout="semibox" data-sidebar-visibility="show" data-topbar="light" data-sidebar="light"
    data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>TemanGenerus | PPG Sragen Barat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
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
            <div class="container-fluid px-3 px-md-4 px-xl-5">
                <div class="d-flex align-items-center justify-content-between" style="height: 72px;">

                    {{-- BRAND --}}
                    <div class="d-flex align-items-center gap-2 gap-md-3">

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
                    <div class="d-flex align-items-center gap-2 gap-md-4">

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

        <main class="flex-grow-1 bg-white">
            <div class="container-fluid px-3 px-xl-5 py-4">
                @livewire('operasional.presensi-kegiatan.index', [
                    'token' => $token
                ])
            </div>
        </main>
        
        <!-- footer -->
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
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
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