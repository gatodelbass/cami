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
        return Inertia::render('Calculator/Index', []);
    }

    public function calculadoraIndice()
    {
        return Inertia::render('Calculator/CalculadoraIndice', []);
    }

     public function calculadoraApgar()
    {
        return Inertia::render('Calculator/CalculadoraApgar', []);
    }

      public function calculadoraZarit()
    {
        return Inertia::render('Calculator/CalculadoraZarit', []);
    }
}
