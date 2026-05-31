<div>
    {{-- MONITORING KEBERHASILAN --}}
    <div class="">
        <div class="mb-3">
            <h6 class="fw-semibold mb-1">
                Monitoring Keberhasilan
            </h6>
            <small class="text-muted">
                Persentase keberhasilan generus pada setiap materi
            </small>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="min-width:250px">
                            Materi
                        </th>
                        @foreach($kelompoks as $kelompok)
                        <th class="text-center">
                            {{ $kelompok->nama_kelompok }}
                        </th>
                        @endforeach
                        <th class="text-center bg-primary-subtle">
                            Avg
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materis as $materi) @php $rowTotal = 0; $rowCount = 0; @endphp
                    <tr>
                        <td>
                            {{ $materi->nama_materi }}
                        </td>
                        @foreach($kelompoks as $kelompok) @php $nilai = $penilaians[ $kelompok->ms_kelompok_id
                        . '_' . $materi->ms_materi_kurikulum_id ] ?? null; $keberhasilan = $nilai?->keberhasilan
                        ?? 0; $rowTotal += $keberhasilan; $rowCount++; @endphp
                        <td class="text-center">
                            {{ number_format($keberhasilan,1) }}%
                        </td>
                        @endforeach
                        <td class="text-center fw-bold">
                            {{ $rowCount ? number_format($rowTotal / $rowCount,1) : 0 }}%
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light fw-bold">
                    <tr>
                        <td>
                            Rata-rata
                        </td>
                        @foreach($kelompoks as $kelompok)
                        <td class="text-center">
                            {{ number_format( $avgKeberhasilanKelompok[$kelompok->ms_kelompok_id]
                            ?? 0, 1 ) }}%
                        </td>
                        @endforeach
                        <td class="text-center bg-primary-subtle">
                            {{ number_format( $grandAvgKeberhasilan, 1 ) }}%
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    {{-- MONITORING KEHADIRAN --}}
    <div class="mb-2">
        <div class="mb-3">
            <h6 class="fw-semibold mb-1">
                Monitoring Kehadiran
            </h6>
            <small class="text-muted">
                Persentase kehadiran generus pada setiap materi
            </small>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="min-width:250px">
                            Materi
                        </th>
                        @foreach($kelompoks as $kelompok)
                        <th class="text-center">
                            {{ $kelompok->nama_kelompok }}
                        </th>
                        @endforeach
                        <th class="text-center bg-success-subtle">
                            Avg
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materis as $materi) @php $rowTotal = 0; $rowCount = 0; @endphp
                    <tr>
                        <td>
                            {{ $materi->nama_materi }}
                        </td>
                        @foreach($kelompoks as $kelompok) @php $nilai = $penilaians[ $kelompok->ms_kelompok_id
                        . '_' . $materi->ms_materi_kurikulum_id ] ?? null; $kehadiran = $nilai?->kehadiran
                        ?? 0; $rowTotal += $kehadiran; $rowCount++; @endphp
                        <td class="text-center">
                            {{ number_format($kehadiran,1) }}%
                        </td>
                        @endforeach
                        <td class="text-center fw-bold">
                            {{ $rowCount ? number_format($rowTotal / $rowCount,1) : 0 }}%
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light fw-bold">
                    <tr>
                        <td>
                            Rata-rata
                        </td>
                        @foreach($kelompoks as $kelompok)
                        <td class="text-center">
                            {{ number_format(
                            $avgKehadiranKelompok[$kelompok->ms_kelompok_id] ?? 0,
                            1
                            ) }}%
                        </td>
                        @endforeach
                        <td class="text-center bg-success-subtle">
                            {{ number_format($grandAvgKehadiran,1) }}%
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>