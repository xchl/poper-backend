<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AuthController as BaseAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthController extends BaseAuthController
{


    /**
     * Show the login page.
     *
     * @return \Illuminate\Contracts\View\Factory|Redirect|\Illuminate\View\View
     */
    public function getLogin()
    {
        return view('login');
    }

    /**
     * User logout.
     *
     */
    public function getLogout(Request $request)
    {
        if(!$request->user()){
            return redirect('/');
        }
        $request->user()->token()->revoke();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->withCookie(\Cookie::forget(config('auth.oauth_client.cookie_name')));
    }

}
