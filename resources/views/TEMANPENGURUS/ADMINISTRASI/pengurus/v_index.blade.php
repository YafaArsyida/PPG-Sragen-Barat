@extends('template_machine_temanpengurus.v_template')
@section('content')
<div class="page-content">
    <div class="container-fluid">
    
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Master Pengurus</h4>
        
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">TemanPengurus</a></li>
                            <li class="breadcrumb-item active">Administrasi</li>
                            <li class="breadcrumb-item active">Master Pengurus</li>
                        </ol>
                    </div>
        
                </div>
            </div>
        </div>

        <div class="row">
            <div class="row-xxl-12">
                @livewire('teman-pengurus.pengurus.index')
                @livewire('teman-pengurus.pengurus.import')
                @livewire('teman-pengurus.pengurus.create')
                @livewire('teman-pengurus.pengurus.edit')
                @livewire('teman-pengurus.pengurus.delete')

                @livewire('teman-pengurus.penempatan-dapukan.index')
                <!-- Offcanvas wrapper statis -->
                <div style="width: 500px;" class="offcanvas offcanvas-end" id="offcanvasDapukan" data-bs-scroll="true"
                    data-bs-backdrop="false" aria-labelledby="offcanvasDapukanLabel">
                
                    <div class="offcanvas-header border-bottom">
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar-sm">
                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                                    <i class="ri-community-line text-primary">
                                    </i>
                                </div>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">
                                    Data Dapukan
                                </h5>
                                <small>
                                    Kelola data dapukan pengurus
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
                        @livewire('teman-pengurus.dapukan.index')
                    </div>
                </div>
                @livewire('teman-pengurus.dapukan.create')
                @livewire('teman-pengurus.dapukan.edit')
                @livewire('teman-pengurus.dapukan.delete')
            </div>
        </div>
    
    </div>
</div>

@endsection