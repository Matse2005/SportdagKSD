<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\RegistrationsExport;
use App\Exports\UnregistratedExport;

class ExportExport implements WithMultipleSheets
{
    use Exportable;

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new RegistrationsExport();
        $sheets[] = new UnregistratedExport();

        return $sheets;
    }
}
