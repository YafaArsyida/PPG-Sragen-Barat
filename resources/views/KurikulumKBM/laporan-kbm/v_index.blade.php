@extends('template_machine.v_template')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Laporan Materi Kurikulum PPG</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kurikulum dan KBM</a></li>
                            <li class="breadcrumb-item active">Laporan Materi Kurikulum PPG</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        @livewire('parameter.periode-jenjang-kelompok-kurikulum')

        <div class="row g-4">
            @livewire('penilaian-kurikulum.index')
        </div>
    </div>
</div>

@endsection