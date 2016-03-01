<?php

namespace App\Http\Controllers;

use App\Session;
use App\Vacation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Program;
use Illuminate\Routing;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Validator;
class VacationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $vacation = new Vacation();
        $sessions = new \Illuminate\Database\Eloquent\Collection;
        return view('admin.edit_vacation',['vacation'=> $vacation,'sessions'=>$sessions,'program_id'=>$id]);
    }

    public function save(){
        $id = Input::get('id');
        $vacation = Vacation::find($id);
        $program_id = Input::get('program_id');
        $flag = 0;
        if(!$vacation){
            $vacation= new Vacation();
            $flag = 1;
        }
        $vacation->program_id = Input::get('program_id');
        $vacation->active = Input::get('active');
        $vacation->year = Input::get('year');
        $vacation->season = Input::get('season');
        $vacation->start_date = date( "Y-m-d" , strtotime(Input::get('start_date')));
        $vacation->finish_date = date( "Y-m-d" ,strtotime(Input::get('finish_date')));
        $vacation->save();
        return redirect('/admin/programs/'.$program_id.'/edit');
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
        $vacation = Vacation::find($id);
        $program_id = $vacation->program_id;
        $sessions = Session::where('vacation_id','=',$vacation->id)->get();
        return view('admin.edit_vacation',['vacation'=> $vacation,'program_id'=>$program_id,'sessions'=>$sessions]);
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
        $vacation = Vacation::find($id);
        $program = Program::find($vacation->program_id);
        $vacation->delete();
        return redirect('/admin/programs/'.$program->id.'/edit');
    }
}
