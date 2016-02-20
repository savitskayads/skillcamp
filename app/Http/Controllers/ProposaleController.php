<?php

namespace App\Http\Controllers;

use App\Children;
use App\User;
use App\Proposale;
use Illuminate\Http\Request;
use App\Temporary_proposale;
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
        $proposales = Proposale::join('childrens','proposales.children_id','=','childrens.id')
            ->join('users','proposales.user_id','=','users.id')
            ->join('programs','proposales.program_id','=','programs.id')
            ->select('proposales.*','childrens.name as children_name','programs.title as program_name',
                'users.name as user_name',
                'programs.start_date as program_start','programs.finish_date as program_finish')
            ->orderBy('proposales.id','desc')
            ->get();
        return view('admin.proposales')->with('proposales',$proposales);
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
    public function create_temporary()
    {
        $proposale = new Temporary_proposale();
        $user_id = Session::get('user_id');
        $proposale->user_id = $user_id;
        $proposale->program_id = Input::get('program_id');
        $proposale->session = Input::get('session');
        if (!Input::get('transfer')){
            $proposale->transfer = 'нет';
        } else {
            $proposale->transfer = Input::get('transfer');
        }
        $proposale->registration_date = date("d.m.Y");
        $proposale->save();
        $program  = Program::find($proposale->program_id);
        $program->busy_places=$program->busy_places+1;
        $program->save();

        $user=User::find($user_id);

        return view('user.proposale_parent')->with('user',$user)->with('proposale_id',$proposale->id);
    }

    public function parent_data_save(){
        $user_id = Input::get('id');
        $proposale_id = Input::get('proposale_id');
        $user = User::find($user_id);
        $user->name = Input::get('name');
        $user->email=Input::get('email');
        $user->phone=Input::get('phone');
        $user->data_processing=Input::get('data_processing');
        $user->passport=Input::get('passport');
        $user->passport_date=Input::get('passport_date');
        $user->save();
        $children = Children::where('user_id','=',$user_id)->first();
        if(!$children){
            $children = new Children();
        }

        return view('user.proposale_children')
            ->with('children',$children)
            ->with('user',$user)
            ->with('proposale_id',$proposale_id);

    }

    public function children_data_save(){

        $children_id = Input::get('children_id');
        $children = Children::find($children_id);
        if(!$children){
            $children = new Children();
        }

        $children->surname =Input::get('surname');
        $children->name =Input::get('name');
        $children->patronymic=Input::get('patronymic');
        $children->birthday_date=Input::get('birthday_date');
        $children->document=Input::get('document');
        $children->document_number=Input::get('document_number');
        $children->member=Input::get('member');
        $children->registration=Input::get('registration');
        $children->save();

        $user_id = Input::get('id');

        $proposale_id = Input::get('proposale_id');
        $temporary_proposale = Temporary_proposale::find($proposale_id);
        $proposale = new Proposale();
        $proposale->children_id = $children_id;
        $proposale->user_id = $user_id;
        $proposale->program_id = $temporary_proposale->program_id;
        $proposale->session = $temporary_proposale->session;
        $proposale->transfer =$temporary_proposale->transfer;
        $proposale->registration_date = $temporary_proposale->registration_date;
        $proposale->save();
        $temporary_proposale->delete();

        return view('user.proposale_success',['children'=> $children]);

    }

    public function all_proposales()
    {
        $user_id = Session::get('user_id');
        $proposales = Proposale::where('proposales.user_id','=',$user_id)
              ->join('childrens','proposales.children_id','=','childrens.id')
            ->join('programs','proposales.program_id','=','programs.id')
            ->select('proposales.*','childrens.name as children_name','programs.title as program_name',
                'programs.start_date as program_start','programs.finish_date as program_finish','childrens.application_form as application_form')
            ->get();

        return view('user.proposales')->with('proposales',$proposales);
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
        $temporary_proposale = Temporary_proposale::find($id);
        $temporary_proposale->delete();
        return view('index');
    }
}
