<?php

namespace App\Exports;

use App\Models\Play;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\Exportable;

class AnswersExport implements FromQuery, WithHeadings
{
    use Exportable;

    public $playId;

    public function __construct(int $playId)
    {
        $this->playId = $playId;
    }

    public function query()
    {

       return DB::table('user_answers')
        ->select(
            'users.id',
            'users.name',
            'users.email',
            'presentations.title as presentation',
            'slides.title as slide',
            'user_answers.question',
            'user_answers.question_type',
            'user_answers.answer',
            'user_answers.correct',
            'user_answers.play_id',
            'user_answers.created_at'
        )
        ->join('users', 'users.id', '=', 'user_answers.user_id')
        ->join('presentations', 'presentations.id', '=', 'user_answers.presentation_id')
        ->join('slides', 'slides.id', '=', 'user_answers.slide_id')
        ->where('user_answers.play_id', $this->playId)
        ->orderBy('users.email');
    }

    public function headings(): array
    {
        // Define the column headings for the Excel file
        return [
            'usu id',
            'nombres',
            'email',
            'presentacion',
            'slide',
            'pregunta',
            'tipo pregunta',
            'respuesta',
            'correcto',
            'sesion id',
            'fecha'
        ];
    }

}
