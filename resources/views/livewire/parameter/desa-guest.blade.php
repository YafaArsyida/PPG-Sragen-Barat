<div class="mt-3 mt-lg-0">
    <div class="input-group">    
        <select wire:model="selectedDesa" class="form-select border-primary-subtle shadow-sm" style="cursor: pointer;"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Pilih Desa">
            @foreach ($select_desa as $item)
            <option value="{{ $item->ms_desa_id }}">
                Desa {{ $item->nama_desa }}
            </option>
            @endforeach
        </select>
        <span class="input-group-text bg-primary-subtle border-primary-subtle text-primary">
            <i class="ri-government-line"></i>
        </span>
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.emit('parameterUpdated', @json($selectedDesa));
        });
    </script>
</div>