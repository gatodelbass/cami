<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Presentation;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PresentationRequest;


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

}
