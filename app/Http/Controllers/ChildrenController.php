<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Request;

use App\Http\Controllers\Controller;
use App\Children;
use Input;
use Illuminate\Routing;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Validator;
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
        $childrens=Children::where('user_id','=',$user_id)->get();
        return view('user.childrens', ['childrens'=> $childrens]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $children = new Children();

        return view('user.edit_children',['children'=> $children]);
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

        $children->save();
        $message = "Вы успешно добавили данные о ребенке";
        return redirect('user/childrens');
    }

    public function sizes(){
        $childrens = Children::all();
        return view('admin.sizes')
            ->with('childrens', $childrens);
    }

    public function documents(){
        $childrens = Children::all();
        return view('admin.documents')
            ->with('childrens', $childrens);
    }

    public function money(){
        $childrens = Children::all();
        return view('admin.money')
            ->with('childrens', $childrens);
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
        $children = Children::find($id);

        return view('user.edit_children',['children'=> $children]);
    }

    public function edit_form()
    {

        return view('user.children_form');
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

}
