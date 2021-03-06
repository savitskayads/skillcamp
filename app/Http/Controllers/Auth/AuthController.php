<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Mail;
use Flash;
use Input;
use Redirect;
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $confirmation_code = str_random(30);

        Mail::send('emails.verify', array('confirmation_code' => $confirmation_code), function($message) {
            $message->to(Input::get('email'), 'User')
                ->subject('Подтверждение e-mail');
        });

         return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'delivery' => $data['delivery'],
            'data_processing' => $data['data_processing'],
            'password' => bcrypt($data['password']),
            'confirmation_code' => $confirmation_code
        ]);
    }

    public function getRegister()
    {
        $all_news = News::where('active','=','1')
            ->get();
        return view('auth.register')->with('all_news',$all_news);
    }

    public function postUserRegister(Request $request)
    {
        $validator = $this->validator($request->all());
        $email = User::where('email','=',$request->input('email'))->count();
        $all_news = News::where('active','=','1')
            ->get();
        if($email>0){
            $message='Пользователь с таким e-mail уже существует';
            return view('auth.register')->with('message', $message)->with('all_news',$all_news);
        }

        if ($validator->fails()) {

            $message='Вы ввели неверные данные';
            return view('auth.register')->with('message', $message)->with('all_news',$all_news);
        }

        $user = $this->create($request->all());
        $email = $user->email;
        $id = $user->id;
        $user->delivery = Input::get('delivery');
        $user->data_processing = Input::get('data_processing');
        $user->save();
        $message = 'Вы зарегистрировались на нашем сайте. Вам на почту поступило письмо с подтверждением Вашего почтового адреса.';
        $message_type = 'not_confirmed';

        return view('emails.confirmation')
            ->with('message',$message)
            ->with('message_type',$message_type)
            ->with('email',$email)
            ->with('all_news',$all_news)
            ->with('id',$id);
    }

    public function check_email(Request $request){
        $email = $request->input('email');
        $user = User::where('email','=',$email)
            ->get();
        if(!$user){
            return 'true';
        } else {
            return 'false';
        }
    }

    public function confirm($confirmation_code)
    {
        if (!$confirmation_code) {
            return view('emails.not-found-code');
        }

        $user = User::where('confirmation_code', $confirmation_code)->first();

        if (!$user) {
            return view('emails.not-found-code');
        }

        $user->confirmed = 1;
        $user->save();

        return redirect()->intended('user');
    }
}
