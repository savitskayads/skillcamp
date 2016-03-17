<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Part;
use App\Vacation;
use Input;


class PartController extends Controller
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

    public function save(){
        $program_id = Input::get('program_id');
        $vacation_id = Input::get('vacation_id');
        $part = Part::find(Input::get('id'));
        if(!$part){
            $part=new Part();
            $part->program_id=$program_id;
            $part->vacation_id=$vacation_id;
        }
        $part->start_date = date( "Y-m-d" , strtotime(Input::get('start_date')));
        $part->finish_date = date( "Y-m-d" ,strtotime(Input::get('finish_date')));
        $part->save();
        return redirect('/admin/programs/vacation/'.$vacation_id.'/edit');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $part = new Part();
        $program_id = Vacation::find($id)->program_id;
        return view('admin.edit_part',['part'=> $part,'program_id'=>$program_id,'vacation_id'=>$id]);
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
    public function edit($id){
        $part = Part::find($id);
        $program_id = $part->program_id;
        $vacation_id = $part->vacation_id;
        return view('admin.edit_part',['vacation_id'=> $vacation_id,'program_id'=>$program_id,'part'=>$part]);
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
        $part = Part::find($id);
        $vacation_id = $part->vacation_id;
        $part->delete();
        return redirect('/admin/programs/vacation/'.$vacation_id.'/edit');
    }
}
