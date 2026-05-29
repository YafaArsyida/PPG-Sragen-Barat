@extends('template_machine.v_template')
@section('content')
<div class="page-content">
    <div class="container-fluid">
    
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Periode & Jenjang KBM</h4>
        
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kurikulum dan KBM</a></li>
                            <li class="breadcrumb-item active">Periode & Jenjang KBM</li>
                        </ol>
                    </div>
        
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-xxl-4">
                @livewire('jenjang-kurikulum.index')
                @livewire('jenjang-kurikulum.create')
                @livewire('jenjang-kurikulum.edit')
                @livewire('jenjang-kurikulum.delete')
            </div>
            <div class="col-xxl-8">
                @livewire('periode-kurikulum.index')
                @livewire('periode-kurikulum.create')
                @livewire('periode-kurikulum.edit')
                @livewire('periode-kurikulum.delete')
            </div>
        </div>
    
    </div>
</div>

@endsection