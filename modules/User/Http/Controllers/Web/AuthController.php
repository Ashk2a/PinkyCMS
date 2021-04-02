<?php


namespace Modules\User\Http\Controllers\Web;


use Modules\Core\Http\Controllers\BaseWebController;

class AuthController extends BaseWebController
{
    public function getLogin() {
        return view('user::public.login');
    }

    public function login() {

    }

    public function getRegister() {
        return view('user::public.register');
    }

    public function register() {

    }

    public function forgotPassword() {

    }
}
