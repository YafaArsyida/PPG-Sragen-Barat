@extends('template_machine.v_template')
@section('content') 
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Profil Pengguna</h4>
        
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Manajemen Sistem</a></li>
                            <li class="breadcrumb-item active">Profil Pengguna</li>
                        </ol>
                    </div>
        
                </div>
            </div>
        </div>
    
        <div class="row">
            @livewire('sistem.pengguna.index')
            @livewire('sistem.pengguna.edit')
            @livewire('sistem.pengguna.reset-password')
        </div>
        <!--end row-->
    
    </div>
</div>
@endsection

