<?php

namespace App\Http\Controllers;

use App\Proposale;
use Illuminate\Support\Facades\Session;
use Request;
use App\Program;
use App\Http\Controllers\Controller;
use App\Children;
use App\User;
use Input;
use Illuminate\Routing;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Validator;
use App\News;
use App\Temporary_proposale;
class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Session::get('user_id');
        $user = User::find($user_id);
        $childrens=Children::where('user_id','=',$user_id)->get();
        $all_news = News::where('active','=','1')
            ->get();
        return view('user.childrens', ['childrens'=> $childrens,'user'=>$user,'all_news'=>$all_news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $children = new Children();
        $all_news = News::where('active','=','1')
            ->get();

        $members= new \Illuminate\Database\Eloquent\Collection;
        return view('user.edit_children',['children'=> $children,'all_news'=>$all_news,'members'=>$members]);
    }

    public function save(){
        $id = Request::input('id');
        $children = Children::find($id);
        $flag = 0;
        if(!$children){
            $children = new Children;
            $flag = 1;
        }
        $children->user_id = Session::get('user_id');
        $children->name = Request::input('name');
        $children->surname = Request::input('surname');
        $children->patronymic = Request::input('patronymic');
        $children->sex = Request::input('sex');
        $children->birthday_date = Request::input('birthday_date');
        $children->document = Request::input('document');
        $children->document_number = Request::input('document_number');
        $children->registration = Request::input('registration');
        $children->adress = Request::input('adress');
        $children->marketing = Request::input('marketing');
        $children->save();
        $all_news = News::where('active','=','1')
            ->get();
        return redirect('user/childrens');
    }

    public function save_application_form(){
        $id = Request::input('id');
        $children = Children::find($id);

        $v = Validator::make(Request::all(), [
            'name' => 'required',
            'surname' => 'required',
            'patronymic' => 'required',
            'sex' => 'required',
            'birthday_date' => 'required',
            'document' => 'required',
            'document_number' => 'required',
            'registration' => 'required',
            'adress' => 'required',
            'index' => 'required',
            'school_number' => 'required',
            'school_class' => 'required',
            'sea' => 'required',
            'sea_item' => 'required',
            'sea_years' => 'required',
            'sport' => 'required',
            'trait' => 'required',
            'pleasure' => 'required',
            'stress' => 'required',
            'things' => 'required',
            'self' => 'required',
            'control' => 'required',
            'communication' => 'required',
            'communication_discomfort' => 'required',
            'conviction' => 'required',
            'bad_baby' => 'required',
            'chronic' => 'required',
            'cold' => 'required',
            'sun' => 'required',
            'diet' => 'required',
            'allergy' => 'required',
            'not_allergy' => 'required',
            'medicine_allergy' => 'required',
            'insects_allergy' => 'required',
            'train' => 'required',
            'ills' => 'required',
            'operations' => 'required',
            'rupture' => 'required',
            'concussion' => 'required',
            'bad_bug' => 'required',
            'another_medicine' => 'required',
            'physics' => 'required',
            'swim' => 'required',
            'fear_height' => 'required',
            'fear_dark' => 'required',
            'fear_animals' => 'required',
            'physics_reaction' => 'required',
            'fatiguability' => 'required',
            'vision' => 'required',
            'health' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'clothing_size' => 'required',
            'family' => 'required'
        ]);

        if ($v->fails())
        {
            $children->application_form='заполнена не полностью';
        }
        else{
            $children->application_form='заполнена';
        }
        $children->user_id = Session::get('user_id');
        $children->name = Request::input('name');
        $children->surname = Request::input('surname');
        $children->patronymic = Request::input('patronymic');
        $children->sex = Request::input('sex');
        $children->birthday_date = Request::input('birthday_date');
        $children->document = Request::input('document');
        $children->document_number = Request::input('document_number');
        $children->registration = Request::input('registration');
        $children->index= Request::input('index');
        $children->adress = Request::input('adress');
        $children->school_number = Request::input('school_number');
        $children->school_class = Request::input('school_class');
        $children->sea = Request::input('sea');
        $children->sea_item = Request::input('sea_item');
        $children->sea_years = Request::input('sea_years');
        $children->sport = Request::input('sport');
        $children->trait = Request::input('trait');
        $children->pleasure = Request::input('pleasure');
        $children->not_pleasure = Request::input('not_pleasure');
        $children->stress = Request::input('stress');
        $children->things = Request::input('things');
        $children->self = Request::input('self');
        $children->control = Request::input('control');
        $children->communication = Request::input('communication');
        $children->communication_discomfort = Request::input('communication_discomfort');
        $children->conviction = Request::input('conviction');
        $children->bad_baby = Request::input('bad_baby');
        $children->marketing = Request::input('marketing');
        $children->chronic = Request::input('chronic');
        $children->cold = Request::input('cold');
        $children->sun = Request::input('sun');
        $children->diet = Request::input('diet');
        $children->allergy = Request::input('allergy');
        $children->not_allergy = Request::input('not_allergy');
        $children->medicine_allergy = Request::input('medicine_allergy');
        $children->insects_allergy = Request::input('insects_allergy');
        $children->train = Request::input('train');
        $children->ills = Request::input('ills');
        $children->operations = Request::input('operations');
        $children->rupture = Request::input('rupture');
        $children->concussion = Request::input('concussion');
        $children->bad_bug = Request::input('bad_bug');
        $children->another_medicine = Request::input('another_medicine');
        $children->physics = Request::input('physics');
        $children->swim = Request::input('swim');
        $children->fear_height = Request::input('fear_height');
        $children->fear_dark = Request::input('fear_dark');
        $children->fear_animals = Request::input('fear_animals');
        $children->physics_reaction = Request::input('physics_reaction');
        $children->fatiguability = Request::input('fatiguability');
        $children->vision = Request::input('vision');
        $children->health = Request::input('health');
        $children->height = Request::input('height');
        $children->weight = Request::input('weight');
        $children->clothing_size = Request::input('clothing_size');
        $children->family = Request::input('family');
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
            $children->image = upload_program_image(Input::file('img'));
        }


        $children->save();
        return redirect('user/childrens');
    }

    public function admin_save(){
        $id = Request::input('id');
        $children = Children::find($id);
        $flag = 0;
        if(!$children){
            $children = new Children;
            $flag = 1;
        }
        $children->name = Request::input('name');
        $children->surname = Request::input('surname');
        $children->sex = Request::input('sex');
        $children->birthday_date = Request::input('birthday_date');
        $children->document = Request::input('document');
        $children->document_number = Request::input('document_number');
        $children->registration = Request::input('registration');
        $children->adress = Request::input('adress');
        $children->school_number = Request::input('school_number');
        $children->school_class = Request::input('school_class');
        $children->sea = Request::input('sea');
        $children->sea_item = Request::input('sea_item');
        $children->sea_years = Request::input('sea_years');
        $children->sport = Request::input('sport');
        $children->trait = Request::input('trait');
        $children->pleasure = Request::input('pleasure');
        $children->stress = Request::input('stress');
        $children->things = Request::input('things');
        $children->self = Request::input('self');
        $children->control = Request::input('control');
        $children->communication = Request::input('communication');
        $children->communication_discomfort = Request::input('communication_discomfort');
        $children->conviction = Request::input('conviction');
        $children->bad_baby = Request::input('bad_baby');
        $children->marketing = Request::input('marketing');
        $children->chronic = Request::input('chronic');
        $children->cold = Request::input('cold');
        $children->sun = Request::input('sun');
        $children->diet = Request::input('diet');
        $children->allergy = Request::input('allergy');
        $children->not_allergy = Request::input('not_allergy');
        $children->medicine_allergy = Request::input('medicine_allergy');
        $children->insects_allergy = Request::input('insects_allergy');
        $children->train = Request::input('train');
        $children->ills = Request::input('ills');
        $children->operations = Request::input('operations');
        $children->rupture = Request::input('rupture');
        $children->concussion = Request::input('concussion');
        $children->bad_bug = Request::input('bad_bug');
        $children->another_medicine = Request::input('another_medicine');
        $children->physics = Request::input('physics');
        $children->swim = Request::input('swim');
        $children->fear_height = Request::input('fear_height');
        $children->fear_dark = Request::input('fear_dark');
        $children->fear_animals = Request::input('fear_animals');
        $children->physics_reaction = Request::input('physics_reaction');
        $children->fatiguability = Request::input('fatiguability');
        $children->vision = Request::input('vision');
        $children->health = Request::input('health');
        $children->height = Request::input('height');
        $children->weight = Request::input('weight');
        $children->clothing_size = Request::input('clothing_size');
        $children->family = Request::input('family');

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

            $children->image = upload_program_image(Input::file('img'));

        }

        $children->save();
        return redirect('admin/childrens');
    }


    public function sizes(){
        $proposales = Proposale::join('childrens','proposales.children_id','=','childrens.id')
            ->join('programs','proposales.program_id','=','programs.id')
            ->select('proposales.*','childrens.*','childrens.id as children_id','programs.title as program_name')
            ->get();

        return view('admin.sizes')
            ->with('proposales', $proposales);
    }

    public function documents(){

        $proposales = Proposale::join('childrens','proposales.children_id','=','childrens.id')
            ->join('programs','proposales.program_id','=','programs.id')
            ->select('proposales.*','childrens.name as children_name','childrens.surname as children_surname',
                'childrens.id as children_id','childrens.document as children_document','programs.title as program_name')
            ->get();
        return view('admin.documents')
            ->with('proposales', $proposales);
    }

    public function money(){
        $proposales = Proposale::join('childrens','proposales.children_id','=','childrens.id')
            ->join('programs','proposales.program_id','=','programs.id')
            ->select('proposales.*','childrens.name as children_name','childrens.surname as children_surname',
                'childrens.id as children_id','programs.title as program_name')
            ->get();
        return view('admin.money')
            ->with('proposales', $proposales);
    }

    public function phones(){
        $childrens = Children::leftJoin('users','users.id','=','childrens.user_id')
            ->select('users.*', 'childrens.name as children_name','childrens.surname as children_surname')
            ->get();
        return view('admin.phones')->with('users',$childrens);
    }

    public function calls(){
        $childrens = Children::leftJoin('users','users.id','=','childrens.user_id')
            ->select('users.*', 'childrens.name as children_name','childrens.surname as children_surname')
            ->get();
        return view('admin.calls')->with('users',$childrens);
    }

    public function outgoing_calls(){
        $childrens = Children::leftJoin('users','users.id','=','childrens.user_id')
            ->select('users.*', 'childrens.name as children_name','childrens.surname as children_surname', 'childrens.registration as children_registration',
                'childrens.adress as children_adress', 'childrens.birthday_date as children_birthday','childrens.family as children_family')
            ->get();
        return view('admin.outgoing_calls')->with('users',$childrens);
    }

    public function show_all(){
        $childrens = Children::all();
        return view('admin.childrens')->with('childrens',$childrens);
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
        $children = Children::find($id);
        $parent = User::find($children->user_id);
        $proposales = Proposale::where('proposales.children_id','=',$children->id)
            ->join('programs','proposales.program_id','=','programs.id')
            ->select('proposales.*','programs.title as program_name')
            ->get();
        return view('admin.show_children')->with('children',$children)->with('parent',$parent)->with('proposales',$proposales);

    }

    public function children_documents($id){
        $children = Children::find($id);
        $all_news = News::where('active','=','1')
            ->get();
        return view('user.documents')->with('children',$children)->with('all_news',$all_news);
    }

    public function save_documents(){

        $children = Children::find(Input::get('id'));
        if(Request::hasFile('document_1')){
            $image = Input::file('document_1');
            $validator = Validator::make(
                array('image' => $image,),
                array('image' => 'mimes:jpeg,bmp,png',)
            );
            $children->document_1 = upload_program_image(Input::file('document_1'));
        }
        if(Request::hasFile('document_2')){
            $image = Input::file('document_2');
            $validator = Validator::make(
                array('image' => $image,),
                array('image' => 'mimes:jpeg,bmp,png',)
            );
            $children->document_2 = upload_program_image(Input::file('document_2'));
        }
        if(Request::hasFile('document_3')){
            $image = Input::file('document_3');
            $validator = Validator::make(
                array('image' => $image,),
                array('image' => 'mimes:jpeg,bmp,png',)
            );
            $children->document_3 = upload_program_image(Input::file('document_3'));
        }
        if(Request::hasFile('document_4')){
            $image = Input::file('document_4');
            $validator = Validator::make(
                array('image' => $image,),
                array('image' => 'mimes:jpeg,bmp,png',)
            );
            $children->document_4 = upload_program_image(Input::file('document_4'));
        }
        if(Request::hasFile('document_5')){
            $image = Input::file('document_5');
            $validator = Validator::make(
                array('image' => $image,),
                array('image' => 'mimes:jpeg,bmp,png',)
            );
            $children->document_5 = upload_program_image(Input::file('document_5'));
        }
        if(Request::hasFile('document_6')){
            $image = Input::file('document_6');
            $validator = Validator::make(
                array('image' => $image,),
                array('image' => 'mimes:jpeg,bmp,png',)
            );
            $children->document_6 = upload_program_image(Input::file('document_6'));
        }
        if(Request::hasFile('document_7')){
            $image = Input::file('document_7');
            $validator = Validator::make(
                array('image' => $image,),
                array('image' => 'mimes:jpeg,bmp,png',)
            );
            $children->document_7 = upload_program_image(Input::file('document_7'));
        }
        if(Request::hasFile('document_8')){
            $image = Input::file('document_8');
            $validator = Validator::make(
                array('image' => $image,),
                array('image' => 'mimes:jpeg,bmp,png',)
            );
            $children->document_8 = upload_program_image(Input::file('document_8'));
        }
        $children->save();
        $all_news = News::where('active','=','1')
            ->get();
        $proposales = Proposale::where('children_id','=',$children->id)->get();
        foreach($proposales as $proposale){
            $program = Program::find($proposale->program_id);
            if(
             (($program->document_1==1&&$children->document_1!="")||$program->document_1==0)&&
             (($program->document_2==1&&$children->document_2!="")||$program->document_2==0)&&
             (($program->document_3==1&&$children->document_3!="")||$program->document_3==0)&&
             (($program->document_4==1&&$children->document_4!="")||$program->document_4==0)&&
             (($program->document_5==1&&$children->document_5!="")||$program->document_5==0)&&
             (($program->document_6==1&&$children->document_6!="")||$program->document_6==0)&&
             (($program->document_7==1&&$children->document_7!="")||$program->document_7==0)&&
             (($program->document_8==1&&$children->document_8!="")||$program->document_8==0)
            ){
                $proposale->documents = 1;
            } else {
                $proposale->documents = "";
            }
        }
        return view('user.documents')->with('children',$children)->with('all_news',$all_news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $children = Children::find($id);
        $members = Proposale::where('proposales.children_id',$id)
            ->join('programs','proposales.program_id','=','programs.id')
            ->select('programs.title as program_title')
            ->get();
        $all_news = News::where('active','=','1')
            ->get();
        return view('user.edit_children',['children'=> $children,'members'=>$members,'all_news'=>$all_news]);
    }

    public function edit_application_form($id){
        $proposale = Proposale::find($id);
        $children_id = $proposale->children_id;
        $children = Children::find($children_id);
        $all_news = News::where('active','=','1')
            ->get();
        if(!$proposale||!$children){
            return view('user.application_form',['proposale'=>$proposale,'children'=> $children,'all_news'=>$all_news]);
        } else {
            return view('user.application_form',['proposale'=>$proposale,'children'=> $children,'all_news'=>$all_news]);
        }
    }

    public function admin_edit($id)
    {
        $children = Children::find($id);
        return view('admin.edit_children',['children'=> $children]);
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
        $user_id = Session::get('user_id');
        $children = Children::find($id);
        $children->delete();
        return redirect('user/childrens');
    }

    public function save_form(){
        return view('form');
    }

}
