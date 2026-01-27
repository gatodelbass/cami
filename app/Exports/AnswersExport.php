<?php

namespace App\Exports;

use App\Models\Play;
use App\Models\UserAnswer;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\Exportable;

class AnswersExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public $playId;

    public function __construct(int $playId)
    {
        $this->playId = $playId;
    }

    public function query()
    {
        return UserAnswer::where("play_id", $this->playId);
    }

     public function headings(): array
    {
        // Define the column headings for the Excel file
        return [
            'ID',
            'Name',
            'Email Address'
        ];
    }

    public function map($user): array
    {
        // Map the selected database columns to the order of the headings
        return [
            $user->id,
            $user->name,
            $user->email
        ];
    }
}
