<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Answer;
use App\Models\Slide;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\AnswerRequest;


use Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Answer/Index', [
            'answers' => Answer::all()
        ]);
    }

    public function filterAnswers($name)
    {

        $tags = Answer::where("name",  'like', '%' . $name . '%')->get();


        return response()->json([
            'tags' => $tags,
        ]);
    }

    public function getanswers($slideId)
    {
        

        $slide = Slide::find($slideId);
       

        $answers = Answer::where("slide_id", $slideId)->orderBy('order')->get();

        return Inertia::render('Answer/Index', [
            'answers' => $answers,
            'slide' => $slide
        ]);
    }



    public function addNewAnswer(Request $request)
    {

        $tagExists = Answer::where("name", $request->name)->first();

        if (!$tagExists) {

            $tag = new Answer();
            $tag->name = $request->name;
            $tag->save();
        }


        $tags = Answer::orderBy("name")->get();

        return back();
    }

    public function edit($answerId)
    {
        $answer = Answer::find($answerId);

        return Inertia::render('Answer/Edit', [
            'answer' => $answer
        ]);
    }

    public function create($slideId)
    {

        return Inertia::render('Answer/Create', [
            'slide' => $slideId
        ]);
    }

    public function store(AnswerRequest $request)
    {


        $answer = Answer::create($request->validated());

        if ($request->image != null) {
            $path = Storage::disk('public')->put('answers', $request->image);
            $answer->image = $path;
            $answer->save();
        }

        // dd($Answer->slide_id);

        return redirect()->route('getanswers', $answer->slide_id);
    }



    public function update(AnswerRequest $request)
    {
        $validatedData = $request->validated();
        $answer = Answer::find($request->id);
        $answer->answer = $request->answer;
        $answer->correct = $request->correct;
        $answer->save();

        if ($request->image != null) {
            $path = Storage::disk('public')->put('answers', $request->image);
            $answer->image = $path;
            $answer->save();
        }

        return redirect()->route('getanswers', $answer->slide_id);
    }

    public function saveAnswerOrder(Request $request)
    {

        $slideId = $request->slide_id;
        $answers = $request->answers;
        $order = 1;
        foreach ($answers as $key => $answer) {
            $answer = Answer::find($answer["id"]);
            $answer->order = $order;
            $answer->save();
            $order++;
        }
    }
}
