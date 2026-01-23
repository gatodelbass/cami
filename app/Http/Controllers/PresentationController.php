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


class PresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Presentation/Index', [
            'presentations' => Presentation::all()
        ]);
    }

    public function filterPresentations($name)
    {

        $tags = Presentation::where("name",  'like', '%' . $name . '%')->get();


        return response()->json([
            'tags' => $tags,
        ]);
    }



    public function addNewPresentation(Request $request)
    {

        $tagExists = Presentation::where("name", $request->name)->first();

        if (!$tagExists) {

            $tag = new Presentation();
            $tag->name = $request->name;
            $tag->save();
        }


        $tags = Presentation::orderBy("name")->get();

        return back();
    }

    public function edit($presentationId)
    {

        $presentation = Presentation::find($presentationId);

        return Inertia::render('Presentation/Edit', [
            'presentation' => $presentation
        ]);
    }

    public function create()
    {

        return Inertia::render('Presentation/Create');
    }

    public function store(PresentationRequest $request)
    {


        $presentation = Presentation::create($request->validated());


        return Redirect::route('presentations.index');
    }

    public function update(PresentationRequest $request)
    {

        // dd($request);

        $presentation = Presentation::find($request->id);
        $presentation->title = $request->title;
        $presentation->save();


        return Redirect::route('presentations.index');
    }


    public function play($presentationId)
    {
        $presentation = Presentation::find($presentationId);
        $totalSlides = Slide::where("presentation_id", $presentationId)->count();


        $slide = Slide::where("presentation_id", $presentationId)->orderBy("order")
            ->with(['slideAnswers' => function ($query) {
                $query->orderBy('order'); // Order posts by creation date, descending
            }])->first();

        $previousPlays = Play::all();

        foreach ($previousPlays as $key => $play) {
            $play->status = "inactivo";
            $play->save();
        }

        $question_types = ["opcion unica", "opcion unica imagen"];

        $slides = Slide::where("presentation_id", $presentation->id)
            ->whereIn('question_type', $question_types)
            ->count();

        $play = new Play();
        $play->presentation_id = $presentation->id;
        $play->slide_id = $slide->id;
        $play->slide_id = $slide->id;
        $play->save();

        return Inertia::render('Presentation/Play', [
            'presentation' => $presentation,
            'slide' => $slide,
            'totalSlides' => $totalSlides,
        ]);
    }

    public function nextSlide($currentSlideId)
    {



        $currentSlide = Slide::find($currentSlideId);

        //dd($currentSlide);


        $changeSlide = Slide::where("presentation_id", $currentSlide->presentation_id)
            ->where("order", $currentSlide->order + 1)
            ->with(['slideAnswers' => function ($query) {
                $query->orderBy('order'); // Order posts by creation date, descending
            }])->first();

        $play = Play::where("status", "activo")->first();
        $play->presentation_id = $changeSlide->presentation_id;
        $play->slide_id = $changeSlide->id;
        $play->save();

        return response()->json([
            'newSlide' => $changeSlide
        ]);
    }

    public function previousSlide($currentSlideId)
    {

        $currentSlide = Slide::find($currentSlideId);


        $changeSlide = Slide::where("presentation_id", $currentSlide->presentation_id)
            ->where("order", $currentSlide->order - 1)
            ->with(['slideAnswers' => function ($query) {
                $query->orderBy('order'); // Order posts by creation date, descending
            }])->first();

        $play = Play::where("status", "activo")->first();
        $play->presentation_id = $changeSlide->presentation_id;
        $play->slide_id = $changeSlide->id;
        $play->save();

        return response()->json([
            'newSlide' => $changeSlide
        ]);
    }
}
