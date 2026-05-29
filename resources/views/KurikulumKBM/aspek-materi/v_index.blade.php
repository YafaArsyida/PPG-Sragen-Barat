@extends('template_machine.v_template')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Aspek Materi Kurikulum PPG</h4>
        
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kurikulum dan KBM</a></li>
                            <li class="breadcrumb-item active">Aspek Materi Kurikulum PPG</li>
                        </ol>
                    </div>
        
                </div>
            </div>
        </div>
    
        @livewire('parameter.periode-jenjang-kurikulum')
    
        <div class="row g-4">
            @livewire('aspek-kurikulum.index')
        </div>
        @livewire('aspek-kurikulum.create')
        @livewire('aspek-kurikulum.edit')
        @livewire('aspek-kurikulum.delete')
    </div>
</div>

@endsection