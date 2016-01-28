<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Session;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->user = $this->auth->user();
    }

    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            return redirect('user/login');
        } else if($this->user->name == 'admin'){
            return redirect('/');
        }

        if(!Session::has('user_id')){
        $user_id = $this->user->id;
        Session::put('user_id',$user_id);
        }

        return $next($request);
    }
}
