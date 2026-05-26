@extends('template_machine_temanpengurus.v_template')
@section('content')

@php
$title = "Dashboard"
@endphp
@push('info-page')
<div class="page-title-right">
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
        <li class="breadcrumb-item active">{{ $title ?? "SmartGate" }}</li>
    </ol>
</div>
@endpush
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard TemanPengurus</h4>
        
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">TemanPengurus</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item active">Dashboard TemanPengurus</li>
                        </ol>
                    </div>
        
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-5">
                <div class="d-flex flex-column h-100">
                    <div class="row g-3">
                    
                        <!-- CTA Presensi Generus -->
                        <div class="col-12">
                            @livewire('teman-pengurus.dashboard.c-t-a-pengurus')
                        </div> <!-- end col-->
                    
                        <!-- Statistik pengurus -->
                        <div class="col-md-6">
                            @livewire('teman-pengurus.dashboard.total-pengurus')
                        </div>
                    
                        <div class="col-md-6">
                            @livewire('teman-pengurus.dashboard.total-kegiatan-pengurus')
                        </div>
                    
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-12">
                            @livewire('teman-pengurus.dashboard.kegiatan-terkini')
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
            <div class="col-xxl-7">
                <div class="row h-100">
                    <!-- Presensi Hari Ini -->
                    <div class="col-xl-7">
                        @livewire('teman-pengurus.dashboard.list-pengurus')
                    </div>
                
                    <!-- Jumlah Kehadiran -->
                    <div class="col-xl-5">
                        @livewire('teman-pengurus.dashboard.ranking-kehadiran-pengurus')
                    </div>
                </div> <!-- end row -->
            </div><!-- end col -->
        </div>
        <div class="row">
            {{-- @livewire('widget.kartu-transaksi-jurnal')
            @livewire('widget.kartu-jurnal-detail') --}}
        </div><!-- end row -->
    </div>
</div>

@endsection