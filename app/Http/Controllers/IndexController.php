<?php

namespace App\Http\Controllers;

use Request;

use Requests;
use App\Http\Controllers\Controller;
use App\Program;
use App\News;
use Input;
use Illuminate\Routing;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Validator;
use Illuminate\Support\Facades\Auth;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monthes = array(
            1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
            5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
            9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря'
        );

        $programs = Program::join('vacations','programs.id','=','vacations.program_id')
            ->where('programs.active','=','1')
            ->where('vacations.active','=',1)
            ->select('programs.*','vacations.*','vacations.id as vacation_id','programs.id as id')
            ->get();

        $all_news = News::where('active','=','1')
            ->get();
        if(Auth::check()){
            $user=Auth::user()->name;
        } else {
            $user='guest';
        }
        return view('index', ['programs' => $programs, 'monthes'=>$monthes, 'all_news'=>$all_news, 'user'=>$user]);

    }

    public function vacations($vacation){

        if($vacation=='winter'){
            $programs = Program::where('programs.active','=','1')
                ->join('vacations','programs.id','=','vacations.program_id')
                ->where('vacations.season','=','Зима')
                ->orderBy('programs.id', 'desc')
                ->select('programs.*','vacations.start_date as start_date','vacations.finish_date as finish_date')
                ->get();
        } elseif($vacation=='spring') {
            $programs = Program::where('programs.active','=','1')
                ->join('vacations','programs.id','=','vacations.program_id')
                ->where('vacations.season','=','Весна')
                ->orderBy('programs.id', 'desc')
                ->select('programs.*','vacations.start_date as start_date','vacations.finish_date as finish_date')
                ->get();
        } elseif($vacation=='summer') {
            $programs = Program::where('programs.active','=','1')
                ->join('vacations','programs.id','=','vacations.program_id')
                ->where('vacations.season','=','Лето')
                ->orderBy('programs.id', 'desc')
                ->select('programs.*','vacations.start_date as start_date','vacations.finish_date as finish_date')
                ->get();
        } elseif($vacation=='autumn') {
            $programs = Program::where('programs.active','=','1')
                ->join('vacations','programs.id','=','vacations.program_id')
                ->where('vacations.season','=','Осень')
                ->orderBy('programs.id', 'desc')
                ->select('programs.id as id','vacations.start_date as start_date','vacations.finish_date as finish_date')
                ->get();
        } elseif($vacation=='weekend') {
            $programs = Program::where('programs.active','=','1')
                ->join('vacations','programs.id','=','vacations.program_id')
                ->where('vacations.season','=','Выходной')
                ->orderBy('programs.id', 'desc')
                ->select('programs.*','vacations.start_date as start_date','vacations.finish_date as finish_date')
                ->get();
        } elseif($vacation=='festival') {
            $programs = Program::where('programs.active','=','1')
                ->join('vacations','programs.id','=','vacations.program_id')
                ->where('vacations.season','=','Фестиваль')
                ->orderBy('programs.id', 'desc')
                ->select('programs.*','vacations.start_date as start_date','vacations.finish_date as finish_date')
                ->get();
        } else {
            $programs = Program::where('programs.active','=','1')
                ->join('vacations','programs.id','=','vacations.program_id')
                ->orderBy('programs.id', 'desc')
                ->select('programs.*','vacations.start_date as start_date','vacations.finish_date as finish_date')
                ->get();
        }
        $all_news = News::where('active','=','1')
            ->get();

        $monthes = array(
            1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
            5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
            9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря'
        );

        if(Auth::check()){
            $user=Auth::user()->name;
        } else {
            $user='guest';
        }
        return view('index', ['programs' => $programs, 'monthes'=>$monthes, 'all_news'=>$all_news, 'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
