<?php

namespace App\Http\Controllers;

use App\Children;
use App\Part;
use App\User;
use App\Proposale;
use Illuminate\Http\Request;
use App\Temporary_proposale;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Program;
use Session;
use Input;
use App\News;
use App\Vacation;

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
        $all_news = News::where('active','=','1')
            ->get();
        return view('admin.proposales')->with('proposales',$proposales)->with('all_news',$all_news);
    }

    public function get_proposale($id){
        $selected_vacation = Vacation::find($id);
        if (!$selected_vacation){
            $selected_program_id=Program::first()->id;
            $selected_vacation = Vacation::where('program_id','=',$selected_program_id)->first();
            $selected_vacation_id = $selected_vacation->id;
        } else {
            $selected_program_id = $selected_vacation->program_id;
            $selected_vacation_id = $id;
        }
        $selected_program = Program::find($selected_program_id);
        $programs = Program::all();
        $vacations = Vacation::where('program_id','=',$selected_program_id)->get();
        $parts = Part::where('vacation_id','=',$selected_vacation_id)->get();
        $user_id = Session::get('user_id');
        $childrens = Children::where('user_id','=',$user_id)->get();
        $all_news = News::where('active','=','1')
            ->get();
        return view('user.proposale')
            ->with('selected_program',$selected_program)
            ->with('selected_vacation',$selected_vacation)
            ->with('programs',$programs)
            ->with('vacations',$vacations)
            ->with('parts',$parts)
            ->with('childrens',$childrens)
            ->with('all_news',$all_news);
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
        $proposale->children_id = Input::get('children');
        $proposale->program_id = Input::get('program_id');
        $proposale->vacation_id = Input::get('vacation_id');
        $proposale->part_id = Input::get('part_id');
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
        $all_news = News::where('active','=','1')
            ->get();
        return view('user.proposale_parent')->with('user',$user)
            ->with('proposale_id',$proposale->id)
            ->with('all_news',$all_news);
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
        $all_news = News::where('active','=','1')
            ->get();

        return view('user.proposale_children')
            ->with('children',$children)
            ->with('user',$user)
            ->with('proposale_id',$proposale_id)
            ->with('all_news',$all_news);

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
        $proposales = Proposale::where('children_id','=',$children_id)->count();
        if ($proposales!=0){
            $children->member=1;
        } else{
            $children->member=0;
            $children->marketing = Input::get('marketing');
        }
        $children->registration=Input::get('registration');
        $children->save();

        $user_id = Input::get('id');

        $proposale_id = Input::get('proposale_id');
        $temporary_proposale = Temporary_proposale::find($proposale_id);
        $proposale = new Proposale();
        $proposale->children_id = $children_id;
        $proposale->user_id = $user_id;
        $proposale->program_id = $temporary_proposale->program_id;
        $proposale->vacation_id = $temporary_proposale->vacation_id;
        $proposale->part_id = $temporary_proposale->part_id;
        $proposale->transfer =$temporary_proposale->transfer;
        $proposale->registration_date = $temporary_proposale->registration_date;
        $proposale->save();
        $temporary_proposale->delete();
        $all_news = News::where('active','=','1')
            ->get();
        return view('user.proposale_success',['children'=> $children, 'all_news'=>$all_news]);

    }

    public function all_proposales()
    {
        $user_id = Session::get('user_id');
        $proposales = Proposale::where('proposales.user_id','=',$user_id)
            ->join('childrens','proposales.children_id','=','childrens.id')
            ->join('programs','proposales.program_id','=','programs.id')
            ->join('vacations','proposales.vacation_id','=','vacations.id')
            ->join('parts','proposales.part_id','=','parts.id')
            ->select('proposales.*','childrens.name as children_name','programs.title as program_name',
                'vacations.start_date as program_start','vacations.finish_date as program_finish',
                'parts.start_date as part_start','parts.finish_date as part_finish',
                'childrens.application_form as application_form','childrens.id as children_id')
            ->get();
        $all_news = News::where('active','=','1')
            ->get();
        return view('user.proposales')->with('proposales',$proposales)->with('all_news',$all_news);
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
        $all_news = News::where('active','=','1')
            ->get();
        return view('index')->with('all_news',$all_news);
    }
}
