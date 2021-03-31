<?php

namespace Modules\User\Http\Controllers\Web;

use Modules\Core\Http\Controllers\BaseWebController;

class LoginController extends BaseWebController
{
    public function index() {
        return view('user::public.login');
    }
}
