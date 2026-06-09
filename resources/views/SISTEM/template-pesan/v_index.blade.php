@extends('template_machine.v_template')
@section('content') 
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <div class="row mb-3 pb-1">
            <div class="col-12">
                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-16 mb-1">Pesan Pengumuman</h4>
                        <p class="text-muted mb-0">Administrasi > Pesan Pengumuman</p>
                    </div>
                    @livewire('parameter.desa')
                </div><!-- end card header -->
            </div>
            <!--end col-->
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xxl-4">
                @livewire('sistem.template-pesan.index')
            </div>
            <div class="col-xxl-8">
                @livewire('sistem.template-pesan.create')
            </div>
        </div>        
    </div>
</div>
@endsection

