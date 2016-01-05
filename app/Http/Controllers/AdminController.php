<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Input;
use App\User;
use Hash;
use View;

class AdminController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      return view('admin.dashboard');

    }

    public function login(){

        if(Auth::check()){
            return redirect('admin');
        } else {
            return view('admin.auth');
        }

    }

    public function authenticate()
    {
        $email=Input::get('email');

        $password=Input::get('password');

        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->intended('admin');
        }
        else {
            return redirect('admin/login');
        }
    }

    public function changepass(){

        $oldPassword=Request::input('oldpass');
        $newPassword=Request::input('newpass');
        $repeatPassword=Request::input('newpass2');
        $user_id=Auth::user()->id;
        $user=User::find($user_id);
        $rightOldPassword=$user->password;

        if (Hash::check($oldPassword, $rightOldPassword)){
            if($newPassword == $repeatPassword){
                $user->password=$newPassword;
                $user->save();
                $message='Пароль успешно изменен';

            } else {
                $message='Введенные пароли не совпадают!';
            }
        } else {
            $message='Введен неверный пароль!';
        }
        return view('admin.changepass')
            ->with('message', $message);


    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
