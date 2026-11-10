<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class ExportGenerus extends DefaultValueBinder implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithCustomValueBinder
{
    private Builder $query;
    private int $rowNumber = 0;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function query(): Builder
    {
        return $this->query;
    }

    public function headings(): array
    {
        return ['No', 'Generus', 'L/P', 'Status', 'Kontak', 'Kelompok', 'Usia', 'Jenjang Usia'];
    }

    public function map($generus): array
    {
        return [
            ++$this->rowNumber,
            $generus->nama_generus,
            $generus->jenis_kelamin,
            $generus->status_generus,
            $generus->nomor_telepon ?: '-',
            $generus->ms_kelompok->nama_kelompok ?? '-',
            $generus->usia ? $generus->usia . ' Tahun' : '-',
            $generus->usia
                ? implode(', ', array_map(
                    fn ($jenjang) => ucfirst(str_replace('_', ' ', $jenjang)),
                    $generus->jenjang_usia
                ))
                : '-',
        ];
    }

    public function bindValue(Cell $cell, $value): bool
    {
        if (is_string($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        return parent::bindValue($cell, $value);
    }
}
