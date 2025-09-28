<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Slide;


use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\SlideRequest;


use Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Slide/Index', [
            'slides' => Slide::all()
        ]);
    }

    public function filterSlides($name)
    {

        $tags = Slide::where("name",  'like', '%' . $name . '%')->get();


        return response()->json([
            'tags' => $tags,
        ]);
    }

    public function getslides($presentationId)
    {

        $slides = Slide::where("presentation_id", $presentationId)->orderBy('order')->get();

        return Inertia::render('Slide/Index', [
            'slides' => $slides,
            'presentation' => $presentationId
        ]);
    }



    public function addNewSlide(Request $request)
    {

        $tagExists = Slide::where("name", $request->name)->first();

        if (!$tagExists) {

            $tag = new Slide();
            $tag->name = $request->name;
            $tag->save();
        }


        $tags = Slide::orderBy("name")->get();

        return back();
    }

    public function edit($slideId)
    {

        $slide = Slide::find($slideId);

        return Inertia::render('Slide/Edit', [
            'slide' => $slide
        ]);
    }

    public function create($presentationId)
    {

        return Inertia::render('Slide/Create', [
            'presentation' => $presentationId
        ]);
    }

    public function store(SlideRequest $request)
    {


        $slide = Slide::create($request->validated());

        if ($request->file != null) {
            $path = Storage::disk('public')->put('slides', $request->file);
            $slide->file = $path;
            $slide->save();
        }

        // dd($slide->presentation_id);

        return redirect()->route('getslides', $slide->presentation_id);
    }



    public function update(SlideRequest $request)
    {
        $validatedData = $request->validated();
        $slide = Slide::find($request->id);
        $slide->title = $request->title;
        $slide->file_type = $request->file_type;
        $slide->question = $request->question;
        $slide->question_type = $request->question_type;
        $slide->save();



        if ($request->file != null) {
            $path = Storage::disk('public')->put('slides', $request->file);
            $slide->file = $path;
            $slide->save();
        }

        return redirect()->route('getslides', $slide->presentation_id);
    }

    public function saveSlideOrder(Request $request)
    {
        $presentationId = $request->presentation_id;
        $slides = $request->slides;
        $order = 1;
        foreach ($slides as $key => $slide) {
            $slide = Slide::find($slide["id"]);
            $slide->order = $order;
            $slide->save();
            $order++;
        }

        return redirect()->route('getslides', $presentationId);
    }
}
