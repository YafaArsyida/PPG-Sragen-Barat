<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportKartuGenerus implements FromView
{
    protected $generus;

    public function __construct($generus)
    {
        $this->generus = $generus;
    }

    public function view(): View
    {
        return view(
            'EXPORTS.kartu-generus',
            [
                'generus' => $this->generus
            ]
        );
    }
}
