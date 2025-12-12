<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Presentation;
use App\Models\Slide;
use App\Models\Answer;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PresentationRequest;
use App\Models\Play;
use Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class GuestController extends Controller
{
    function playNowGuest()
    {


        $play = Play::first();
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



        $play = Play::first();

        $slide = Slide::find($play->slide_id);

        $answers = Answer::where("slide_id", $slide->id)->orderBy("order")->get();

        return response()->json([
            'answers' => $answers,
            'slide' => $slide,
        ]);
    }
}
