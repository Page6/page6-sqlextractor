<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        if ($this->registered($request)) {
            $message = 'user '.$request->input('name').' has been register!';
            return view('message', ['type'=>'warning', 'message'=>$message]);
        }

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        return $this->registered($request, $user)
                        ? view('message', ['type'=>'success', 'message'=>'user '.$request->input('name').' register success!'])
                        : redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request)
    {
        $users = DB::select("
            SELECT *
            FROM users
            WHERE name = ?",
            [$request->input('name')]);
        if (sizeof($users)) {
            return true;
        }

        return false;
    }
}
