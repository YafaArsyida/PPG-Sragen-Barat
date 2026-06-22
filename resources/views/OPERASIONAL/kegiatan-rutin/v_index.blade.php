@extends('template_machine.v_template')
@section('content')
<div class="page-content">
    <div class="container-fluid">
    
        <div class="row mb-3 pb-1">
            <div class="col-12">
                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-16 mb-1">Operasional Kegiatan Rutin Generus</h4>
                        <p class="text-muted mb-0">Operasional > Kegiatan Rutin</p>
                    </div>
                    @livewire('parameter.desa')
                </div><!-- end card header -->
            </div>
            <!--end col-->
        </div>

        <div class="row">
            <div class="row-xxl-12">
                @livewire('operasional.kegiatan-rutin.index')
                @livewire('operasional.kegiatan-rutin.report')
                @livewire('operasional.kegiatan-rutin.status')

                @livewire('administrasi.kegiatan-generus.create')

                @livewire('administrasi.kegiatan-generus.detail')
                @livewire('infaq.create')
                @livewire('infaq.edit')
            </div>
        </div>
    
    </div>
</div>

@endsection