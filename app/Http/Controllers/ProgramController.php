<?php

namespace App\Http\Controllers;

use App\Part;
use App\Vacation;
use Request;
use Requests;
use App\Http\Controllers\Controller;
use App\Program;
use App\News;
use Input;
use Illuminate\Routing;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Validator;
class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $programs=Program::all();
//        $programs=Program::join('vacations', 'programs.vacation', '=', 'vacations.id')
//            ->select('programs.*', 'vacations.title as vacation_title')
//            ->get();
        return view('admin.programs', ['programs'=> $programs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $program = new Program();
        return view('admin.edit_program',['program'=> $program]);
    }

    public function save(){
        $id = Request::input('id');
        $program = Program::find($id);
        $flag = 0;
        if(!$program){
            $program = new Program;
            $flag = 1;
        }
        $program->title = Request::input('title');
        $program->address = Request::input('address');
        $program->telephone = Request::input('telephone');
        $program->price = Request::input('price');
        $program->places = Request::input('places');
        $program->season = Request::input('season');
        $program->age = Request::input('age');
        $program->sex = Request::input('sex');
        $program->action_price = Request::input('action_price');
        $program->action_description = Request::input('action_description');
        $program->description = Request::input('description');
        $program->active = Request::input('active');
        $program->document_1 = Request::input('document_1');
        $program->document_2 = Request::input('document_2');
        $program->document_3 = Request::input('document_3');
        $program->document_4 = Request::input('document_4');
        $program->document_5 = Request::input('document_5');
        $program->document_6 = Request::input('document_6');
        $program->document_7 = Request::input('document_7');
        $program->document_8 = Request::input('document_8');
        $program->save();
        if(Request::hasFile('img')){

            $image = Input::file('img');
            $validator = Validator::make(
                array(

                    'image' => $image,
                ),
                array(
                    'image' => 'mimes:jpeg,bmp,png',

                )
            );

            if ($validator->fails())
            {
                $error_messages = $validator->messages();
                $message = "Invalid Input File";
                $type = "failed";
                return Redirect::to('admin/programs/{id}/edit')->with('message',$message);

            } else{
                $program->image = upload_program_image(Input::file('img'));
                $program->save();
            }

        } else{
            if($flag == 1){
                //$program->image_url ="default_product.png";
            }
        }
        return redirect('admin/programs/'.$program->id.'/edit');
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
        $program = Program::find($id);
        $vacations = Vacation::where('program_id','=',$id)->get();
        $all_news = News::where('active','=','1')
            ->get();
        return view('event', ['program' => $program, 'all_news'=>$all_news,'vacations'=>$vacations]);

    }

    public function show_all(){
        $programs = Program::where('programs.active','=',1)
            ->leftJoin('vacations','programs.id','=','vacations.program_id')
            ->leftJoin('parts','vacations.id','=','parts.vacation_id')
            ->select('programs.*','vacations.start_date as vacation_start','vacations.finish_date as vacation_finish',
                'parts.start_date as part_start','parts.finish_date as part_finish')
            ->orderBy('vacations.start_date', 'desc')
            ->get();
        $all_news = News::where('active','=','1')
            ->get();
        $all_programs = Program::where('programs.active','=',1)->get();
        if(Request::format() == 'json'){
            return $programs->toJson();
        } else {
            return view('user.all_programs')->with('programs',$programs)->with('all_news',$all_news)->with('all_programs',$all_programs);
        }
    }

    public function select_programs(){
//        $year = Input::get('year');
        $season = Input::get('season');
        $program = Input::get('program');



        if($program != "*" && $season != "*"){
            $programs = Program::where('programs.active','=',1)
                ->leftJoin('vacations','programs.id','=','vacations.program_id')
                ->leftJoin('parts','vacations.id','=','parts.vacation_id')
                ->select('programs.*','vacations.start_date as vacation_start','vacations.finish_date as vacation_finish',
                    'parts.start_date as part_start','parts.finish_date as part_finish')
                ->orderBy('vacations.start_date', 'desc')
                ->where('programs.id','=',$program)->where('programs.season','=',$season)
                ->get();
        }
        elseif($season != "*" && $program == "*"){
            $programs = Program::where('programs.active','=',1)
                ->leftJoin('vacations','programs.id','=','vacations.program_id')
                ->leftJoin('parts','vacations.id','=','parts.vacation_id')
                ->select('programs.*','vacations.start_date as vacation_start','vacations.finish_date as vacation_finish',
                    'parts.start_date as part_start','parts.finish_date as part_finish')
                ->orderBy('vacations.start_date', 'desc')
                ->where('programs.season','=',$season)
                ->get();
        } elseif($season == "*" && $program != "*"){
            $programs = Program::where('programs.active','=',1)
                ->leftJoin('vacations','programs.id','=','vacations.program_id')
                ->leftJoin('parts','vacations.id','=','parts.vacation_id')

                ->select('programs.*','vacations.start_date as vacation_start','vacations.finish_date as vacation_finish',
                    'parts.start_date as part_start','parts.finish_date as part_finish')
                ->orderBy('vacations.start_date', 'desc')
                ->where('programs.id','=',$program)
                ->get();
        } else {
            $programs = Program::where('programs.active','=',1)
                ->leftJoin('vacations','programs.id','=','vacations.program_id')
                ->leftJoin('parts','vacations.id','=','parts.vacation_id')
                ->select('programs.*','vacations.start_date as vacation_start','vacations.finish_date as vacation_finish',
                    'parts.start_date as part_start','parts.finish_date as part_finish')
                ->orderBy('vacations.start_date', 'desc')
                ->get();
        }

        $all_news = News::where('active','=','1')
            ->get();
        $all_programs = Program::where('programs.active','=',1)->get();

        if(Request::format() == 'json'){
            return $programs->toJson();
        } else {
            return view('user.all_programs')->with('programs',$programs)->with('all_news',$all_news)->with('all_programs',$all_programs);
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $program = Program::find($id);
        $vacations = Vacation::where('program_id','=',$id)->get();

        return view('admin.edit_program',['program'=> $program,'vacations'=>$vacations]);
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
        $program = Program::find($id);
        $program->delete();
        return 'true';
    }

    public function publish($id)
    {
        $program = Program::find($id);
        $program->active = 1;
        $program -> save();
        return 'true';
    }
    public function unpublish($id)
    {
        $program = Program::find($id);
        $program->active = 0;
        $program -> save();
        return 'true';
    }

    public function get_program($id){
        $program = Program::find($id);
        $vacations = Vacation::where('program_id','=',$id)->get();
        return $vacations->toJson();
    }

    public function get_vacation($id){
        $vacation = Vacation::find($id);
        $parts = Part::where('vacation_id','=',$id)->get();
        return $parts->toJson();
    }
}
