<?php

namespace App\Http\Controllers;

use App\Child;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
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
        return view('user.person');
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
