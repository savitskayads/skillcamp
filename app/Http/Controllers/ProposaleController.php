<?php

namespace App\Http\Controllers;

use App\Children;
use App\User;
use App\Proposale;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Program;
use Session;
use Input;

class ProposaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.proposales');
    }

    public function get_proposale($id){
        $selected_program_id = $id;
        if(!$selected_program_id){
            $selected_program_id = 0;
        }
        $programs = Program::all();
        return view('user.proposale')->with('programs',$programs)->with('selected_program_id',$selected_program_id);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proposale = new Proposale();
        $user_id = Session::get('user_id');
        $proposale->user_id = $user_id;
        $proposale->program_id = Input::get('program_id');
        if (!$proposale->transfer){
            $proposale->transfer = 'нет';
        } else {
            $proposale->transfer = Input::get('transfer');
        }
        $proposale->registration_date = date("d.m.Y");
        $proposale->save();
        $user=User::find($user_id);
        return view('user.proposale_parent')->with('user',$user)->with('proposale_id',$proposale->id);
    }

    public function parent_data_save(){
        $id = Input::get('id');
        $proposale_id = Input::get('proposale_id');
        $user = User::find($id);
        $user->name = Input::get('name');
        $user->email=Input::get('email');
        $user->phone=Input::get('phone');
        $user->save();
        $children = new Children();
        $children->user_id = $id;
        $children->save();

        return view('user.proposale_children')
            ->with('children',$children)
            ->with('user',$user)
            ->with('proposale_id',$proposale_id);

    }

    public function children_data_save(){

        $children_id = Input::get('children_id');
        $children = Children::find($children_id);
        $children->surname =Input::get('surname');
        $children->name =Input::get('name');
        $children->patronymic=Input::get('patronymic');
        $children->birthday_date=Input::get('birthday_date');
        $children->document=Input::get('document');
        $children->document_number=Input::get('document_number');
        $children->member=Input::get('member');
        $children->registration=Input::get('registration');
        $children->save();

        $id = Input::get('id');
        $user = User::find($id);
        $user->passport=Input::get('passport');
        $user->passport_date=Input::get('passport_date');
        $user->save();

        $proposale_id = Input::get('proposale_id');
        $proposale = Proposale::find($proposale_id);
        $proposale->children_id = $children_id;
        $proposale->save();


        return view('user.edit_children',['children'=> $children]);


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
