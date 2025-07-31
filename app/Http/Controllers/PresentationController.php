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

    public function editPresentation(Request $request)
    {

        $tagExists = Presentation::where("name", $request->oldName)->first();

        if ($tagExists) {
            $tagExists->name = $request->name;
            $tagExists->save();
        }

        return back();
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




     public function camping()
    {
       

        return Inertia::render('CampingIndex', [
           
        ]);
    }
}
