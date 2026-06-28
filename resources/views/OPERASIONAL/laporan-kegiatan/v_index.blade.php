@extends('template_machine.v_template')
@section('content')
<div class="page-content">
    <div class="container-fluid">
    
        <div class="row mb-3 pb-1">
            <div class="col-12">
                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-16 mb-1">Laporan Kegiatan Generus</h4>
                        <p class="text-muted mb-0">Operasional > Laporan Kegiatan</p>
                    </div>
                    @livewire('parameter.desa')
                </div><!-- end card header -->
            </div>
            <!--end col-->
        </div>

        <div class="row">
            <div class="row-xxl-12">
                @livewire('laporan-kegiatan.index')

                @livewire('laporan-kegiatan.kegiatan-event.report')

                @livewire('laporan-kegiatan.kegiatan-rutin.report')

                @livewire('laporan-kegiatan.kegiatan-khusus.report')


                @livewire('laporan-kegiatan.status')

                @livewire('administrasi.kegiatan-generus.create')
                @livewire('administrasi.kegiatan-generus.detail')

                @livewire('infaq.index')
            </div>
        </div>
    
    </div>
</div>

@endsection