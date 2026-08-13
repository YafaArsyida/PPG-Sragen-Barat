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
    <link href="{{asset('assets')}}/libs/alertifyjs/build/css/themes/default.min.css" rel="stylesheet"
        type="text/css" />
</head>

<body>
    <div class="page-content">
        <div class="container-fluid" style="max-width: 1100px; margin: 0 auto;">
            {{-- PAGE HEADER --}}
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column gap-2">

                        {{-- TITLE --}}
                        <div class="flex-grow-1">
                            <h4 class="fs-16 mb-1 fw-semibold">
                                Monitoring Generus
                            </h4>

                            <p class="text-muted mb-0">
                                Pantau data, kehadiran, dan aktivitas generus
                            </p>
                        </div>

                        {{-- PARAMETER DESA --}}
                        @livewire('parameter.desa-guest')

                    </div>
                </div>
            </div>


            {{-- MONITORING INTRO --}}
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-4 p-lg-5">

                            {{-- BADGE --}}
                            <div class="mb-3">
                                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                    <i class="ri-dashboard-3-line me-1"></i>
                                    TemanGenerus
                                </span>
                            </div>

                            {{-- TITLE --}}
                            <h2 class="fw-bold mb-2 lh-base">
                                Pantau Generus,
                                <span class="text-primary">
                                    Kehadiran & Kegiatan
                                </span>
                            </h2>

                            {{-- DESCRIPTION --}}
                            <p class="text-muted fs-15 mb-0" style="max-width: 800px;">
                                Lihat kondisi generus, tingkat kehadiran, kelompok,
                                dan aktivitas kegiatan secara terpusat.
                            </p>

                        </div>
                    </div>
                </div>
            </div>

            {{-- ========================================================= --}}
            {{-- STATISTIK --}}
            {{-- ========================================================= --}}
            @livewire('monitoring.kegiatan-generus.statistik')

            {{-- ========================================================= --}}
            {{-- MONITORING --}}
            {{-- ========================================================= --}}
            @livewire('monitoring.kegiatan-generus.index')
            @livewire('monitoring.kegiatan-generus.detail')

        </div>
    </div>

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
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(event.detail.message);
                });
    
                window.addEventListener('alertify-error', event => {
                    alertify.set('notifier', 'position', 'top-right');
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
    
    </script>
</body>

</html>