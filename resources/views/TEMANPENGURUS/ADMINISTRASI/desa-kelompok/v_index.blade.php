@extends('template_machine_temanpengurus.v_template')
@section('content') 
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Desa & Kelompok</h4>
        
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Administrasi</a></li>
                            <li class="breadcrumb-item active">Desa & Kelompok</li>
                        </ol>
                    </div>
        
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xxl-12">
                @livewire('administrasi.kelompok.index')
                @livewire('administrasi.kelompok.detail')
                @livewire('administrasi.kelompok.create')
                @livewire('administrasi.kelompok.edit')
                @livewire('administrasi.kelompok.delete')

                <!-- Offcanvas wrapper statis -->
                <div style="width: 500px;" class="offcanvas offcanvas-end" id="offcanvasDesa" data-bs-scroll="true"
                    data-bs-backdrop="false" aria-labelledby="offcanvasDesaLabel">
        
                    <div class="offcanvas-header border-bottom ">
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar-sm">
                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                                    <i class="ri-community-line text-primary">
                                    </i>
                                </div>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">
                                    Data Desa
                                </h5>
                                <small>
                                    Kelola administrasi data Desa dan masjid
                                </small>
                            </div>
                        </div>
                        <button type="button" class="btn btn-light btn-icon rounded-circle" data-bs-dismiss="offcanvas">
                            <i class="ri-close-line fs-18">
                            </i>
                        </button>
                    </div>
        
                    <div class="offcanvas-body">
                        {{-- hanya isinya Livewire --}}
                        @livewire('administrasi.desa.index')
                    </div>
                </div>
                @livewire('administrasi.desa.detail')
                @livewire('administrasi.desa.create')
                @livewire('administrasi.desa.edit')
                @livewire('administrasi.desa.delete')
            </div>
        </div>      
    </div>
</div>
@endsection

