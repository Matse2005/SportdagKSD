<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\RegistrationsExport;
use App\Exports\UnregistratedExport;
use App\Exports\AnswersExport;

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
        $sheets[] = new AnswersExport();

        return $sheets;
    }
}
