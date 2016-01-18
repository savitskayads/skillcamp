<?php

namespace App\Http\Controllers;

use Request;

use Requests;
use App\Http\Controllers\Controller;
use App\Program;
use App\Vacation;
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

        $vacations=Vacation::all();
        return view('admin.edit_program',['vacations' => $vacations,'program'=> $program]);
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
        $program->vacations()->sync(Request::input('vacation'));
        $program->age = Request::input('age');
        $program->start_date = Request::input('start_date') ;
        $program->finish_date = Request::input('finish_date') ;
        $program->description = Request::input('description');
        $program->active = Request::input('active');
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
        $program = Program::find($id);

        $program_vacations=Program::find($id)->vacations()->get();
        $vacation_ids = array();
        foreach($program_vacations as $one){
            $vacation_ids[]=$one->id;
        }

        $vacations=Vacation::all();


        return view('admin.edit_program',['vacations' => $vacations,'program'=> $program,'vacation_ids'=>$vacation_ids]);
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
