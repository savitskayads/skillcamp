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
        $program->vacation = Request::input('vacation');
        $program->age = Request::input('age');
        $program->sex = Request::input('sex');
        $program->action_price = Request::input('action_price');
        $program->action_description = Request::input('action_description');
        $program->start_date = Request::input('start_date') ;
        $program->finish_date = Request::input('finish_date') ;
        $program->session_1_start = Request::input('session_1_start') ;
        $program->session_1_finish = Request::input('session_1_finish') ;
        $program->session_2_start = Request::input('session_2_start') ;
        $program->session_2_finish = Request::input('session_2_finish') ;
        $program->session_3_start = Request::input('session_3_start') ;
        $program->session_3_finish = Request::input('session_3_finish') ;
        $program->description = Request::input('description');
        $program->active = Request::input('active');
        $program->document_1 = Request::input('document_1');
        $program->document_2 = Request::input('document_2');
        $program->document_3 = Request::input('document_3');
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
        $all_news = News::where('active','=','1')
            ->get();
        return view('event', ['program' => $program, 'all_news'=>$all_news]);

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
        return view('admin.edit_program',['program'=> $program]);
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
}
