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
            'presentations' => Slide::all()
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

        $slides = Slide::where("presentation_id", $presentationId)->get();

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

    public function editSlide(Request $request)
    {

        $tagExists = Slide::where("name", $request->oldName)->first();

        if ($tagExists) {
            $tagExists->name = $request->name;
            $tagExists->save();
        }

        return back();
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

        return Redirect::route('slides.index');
    }
}
