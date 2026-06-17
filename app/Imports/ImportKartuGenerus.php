<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportKartuGenerus implements ToCollection, WithHeadingRow
{
    protected $collection;

    public function collection(Collection $rows)
    {
        $this->collection = $rows;
    }

    public function getCollection()
    {
        return $this->collection;
    }
}
