<?php

namespace App\Http\Controllers;

use App\Child;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Session;
use Input;
use App\User;
use Validator;
use Mail;
use Flash;
use Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Session::get('user_id');
        $user = User::find($id);
        return view('user.person')->with('user',$user);
    }

    public function login(){

        if(Auth::check()){
            return view('user.person');
        } else {
            return view('auth.login');
        }
    }

    public function authenticate()
    {
        $email=Input::get('email');
        $password=Input::get('password');
        $message = '';

        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            if(Auth::user()->confirmed != 1){
                $id = Auth::user()->id;
                $message = 'e-mail не подтвержден!';
                $message_type = 'not_confirmed';
                return view('auth.login')
                    ->with('message',$message)
                    ->with('message_type',$message_type)
                    ->with('email',$email)
                    ->with('id',$id);
            }
            return redirect()->intended('user');
        }
        else
        {
            $message = 'Неверные данные!';
            $message_type = 'data_error';
            return view('auth.login')
                ->with('message',$message)
                ->with('message_type',$message_type)
                ->with('email',$email);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function confirmation_code($id){

        $confirmation_code = str_random(30);

        $user = User::find($id);
        $email = $user->email;
        $user->confirmation_code = $confirmation_code;
        $user->save();
        Mail::send('emails.verify', array('confirmation_code' => $confirmation_code,'email' => $email), function($message) use ($email) {
            $message->to($email, 'User')
                ->subject('Подтверждение e-mail');
        });
        return view('auth.login');
    }

    public function create()
    {
        //
    }
//admin actions
    public function show_all(){
        $users = User::where('name','!=','admin')->get();
        return view('admin.users')->with('users',$users);
    }

    public function admin_create()
    {
        $user = new User();
        return view('admin.edit_user')->with('user',$user);
    }

    public function admin_edit($id)
    {
        $user = User::find($id);
        return view('admin.edit_user',['user'=> $user]);
    }

    public function admin_save()
    {
        $id = Input::get('id');
        $user = User::find($id);
        if(!$user) {
            $user = new User;
        }
        $user->name = Input::get('name');
        $user->email=Input::get('email');
        $user->confirmed=Input::get('confirmed');
        $user->phone=Input::get('phone');
        $user->save();
        return redirect('admin/users');
    }

    public function admin_destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('admin/users');
    }


    public function save()
    {
        $id = Input::get('id');
        $user = User::find($id);
        $user->name = Input::get('name');
        $user->email=Input::get('email');
        $user->phone=Input::get('phone');
        if(Input::get('passport')){
            $user->passport=Input::get('passport');
            $user->passport_date=Input::get('passport_date');
        }
        $user->data_processing=Input::get('data_processing');
        $user->delivery=Input::get('delivery');
        $user->save();
        return redirect('user/'.$user->id.'/edit');
    }

    public function check_email()
    {
        $email = Request::input('email');
        $users = User::where('email','=',$email)->count();
        if($users > 0){
            return 'false';
        }else {
            return 'true';
        }
    }

    public function check_password()
    {
        $email = Input::get('email');
        $users = User::where('email','=',$email)->count();
        if($users > 0) {
            return 'false';
        }else {
            return 'true';
        }
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
        $user = User::find($id);
        return view('user.edit',['user'=> $user]);
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
