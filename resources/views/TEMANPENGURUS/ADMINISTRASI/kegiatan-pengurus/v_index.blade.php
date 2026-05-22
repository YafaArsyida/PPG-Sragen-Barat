@extends('template_machine_temanpengurus.v_template')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Kegiatan Pengurus</h4>
        
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">TemanPengurus</a></li>
                            <li class="breadcrumb-item active">Administrasi</li>
                            <li class="breadcrumb-item active">Kegiatan Pengurus</li>
                        </ol>
                    </div>
        
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row-xxl-12">
                @livewire('teman-pengurus.kegiatan-pengurus.index')
                @livewire('teman-pengurus.kegiatan-pengurus.detail')
                @livewire('teman-pengurus.kegiatan-pengurus.edit')
                @livewire('teman-pengurus.kegiatan-pengurus.create')
                @livewire('teman-pengurus.kegiatan-pengurus.delete')
            </div>
        </div>
    
    </div>
</div>

@endsection