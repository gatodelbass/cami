<?php

namespace App\Http\Controllers;

use App\Exports\PlayExport;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Presentation;
use App\Models\Slide;
use App\Models\Answer;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PresentationRequest;
use App\Models\Play;
use App\Models\UserAnswer;
use Carbon;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;


class PlayController extends Controller
{
    function playNow()
    {


        $play = Play::where("status", "activo")->first();
        $slide = Slide::find($play->slide_id);

        $answers = Answer::where("slide_id", $slide->id)->orderBy("order")->get();

        return Inertia::render('Presentation/PlayNow', [

            'play' => $play,
            'answers' => $answers,
            'slide' => $slide,

        ]);
    }

    public function updatePlaySlide()
    {
        $play = Play::where("status", "activo")->first();

        $slide = Slide::find($play->slide_id);

        $answers = Answer::where("slide_id", $slide->id)->orderBy("order")->get();

        return response()->json([
            'answers' => $answers,
            'slide' => $slide,
        ]);
    }

    public function guestRefresh()
    {
        $play = Play::where("status", "activo")->first();

        $slide = Slide::find($play->slide_id);

        $answers = Answer::where("slide_id", $slide->id)->orderBy("order")->get();

        return response()->json([
            'answers' => $answers,
            'slide' => $slide,
        ]);
    }

    public function guestSaveAnswer($answerId)
    {
        $answer = Answer::find($answerId);
        $slide = Slide::find($answer->slide_id);
        $play = Play::where("status", "activo")->first();

        $previousUserAnswer = UserAnswer::where("presentation_id", $slide->presentation_id)
            ->where("slide_id", $slide->id)
            ->where("user_id", Auth::id())
            ->where("play_id", $play->id)->first();

        if ($previousUserAnswer) {
            //ya se guardo la rta
        } else {
            $userAnswer = new UserAnswer();
            $userAnswer->presentation_id = $slide->presentation_id;
            $userAnswer->user_id = Auth::id();
            $userAnswer->slide_id = $slide->id;
            $userAnswer->play_id = $play->id;
            $userAnswer->question = $slide->question;
            $userAnswer->question_type = $slide->question_type;
            $userAnswer->answer = $answer->answer;
            $userAnswer->correct = $answer->correct;
            $userAnswer->save();
        }
    }

    public function plays()
    {
       

        $plays = Play::orderBy("created_at", "desc")->get();


        return Inertia::render('Play/Index', [
            'plays' => $plays,
        ]);
    }

    public function downloadExcel($playId)
    {
        $play = Play::find($playId);

        //dd($playId);


 if (ob_get_contents()) ob_end_clean(); 
    

 return (new PlayExport($playId))->download('invoices.xlsx');
   // return Excel::download(new PlayExport, 'sesion.xlsx');

       
    }
    
}
