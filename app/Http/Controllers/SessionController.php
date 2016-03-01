<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Session;
use App\Vacation;
use Input;

class SessionController extends Controller
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
        $session = Session::find(Input::get('id'));
        if(!$session){
            $session=new Session();
            $session->program_id=$program_id;
            $session->vacation_id=$vacation_id;
        }
        $session->start_date = date( "Y-m-d" , strtotime(Input::get('start_date')));
        $session->finish_date = date( "Y-m-d" ,strtotime(Input::get('finish_date')));
        $session->save();
        return redirect('/admin/programs/vacation/'.$vacation_id.'/edit');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $session = new Session();
        $program_id = Vacation::find($id)->program_id;
        return view('admin.edit_session',['session'=> $session,'program_id'=>$program_id,'vacation_id'=>$id]);
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
        $session = Session::find($id);
        $program_id = $session->program_id;
        $vacation_id = $session->vacation_id;
        return view('admin.edit_session',['vacation_id'=> $vacation_id,'program_id'=>$program_id,'session'=>$session]);
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
        $session = Session::find($id);
        $vacation_id = $session->vacation_id;
        $session->delete();
        return redirect('/admin/programs/vacation/'.$vacation_id.'/edit');
    }
}
