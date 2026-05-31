<div class="card border-0 shadow-sm rounded-4 mb-3">
    <div class="card-body p-3 p-lg-4">
        {{-- HEADER --}}
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <h5 class="mb-1 fw-semibold">
                    Monitoring KBM
                </h5>
                <p class="text-muted mb-0 fs-13">
                    Pilih desa dan periode untuk melihat monitoring KBM
                </p>
            </div>
            <div class="d-none d-lg-block">
                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                    <i class="ri-bar-chart-line me-1">
                    </i>
                    Parameter Aktif
                </span>
            </div>
        </div>
        {{-- FILTER --}}
        <div class="row g-3">
            {{-- DESA --}}
            <div class="col-lg-6">
                <label class="form-label fw-semibold text-muted small mb-2">
                    Desa
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-primary">
                        <i class="ri-community-line">
                        </i>
                    </span>
                    <select wire:model.live="selectedDesa" class="form-select border-start-0 shadow-none"
                        style="cursor: pointer;" @if(Auth::user()->
                        peran !== 'SUPERADMIN') disabled @endif > @foreach ($select_desa as $item)
                        <option value="{{ $item->ms_desa_id }}">
                            {{ $item->nama_desa }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- PERIODE --}}
            <div class="col-lg-6">
                <label class="form-label fw-semibold text-muted small mb-2">
                    Periode Kurikulum
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-primary">
                        <i class="ri-calendar-event-line">
                        </i>
                    </span>
                    <select wire:model.live="selectedPeriode" class="form-select border-start-0 shadow-none"
                        style="cursor: pointer;">
                        @foreach ($select_periode as $item)
                        <option value="{{ $item->ms_periode_kurikulum_id }}">
                            {{ $item->nama_periode }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:load',
  function() {

    Livewire.emit('parameterMonitoringKbmUpdated', {
      periode: @json($selectedPeriode),
      desa: @json($selectedDesa),
    });

  });
</script>