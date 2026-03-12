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


class CalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Calculator/Index', [
            
        ]);
    }

}
