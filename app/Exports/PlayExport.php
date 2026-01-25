<?php

namespace App\Exports;

use App\Models\Play;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class PlayExport implements FromQuery
{
    use Exportable;

    public $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function query()
    {
        return Play::find($this->id);
    }
}
