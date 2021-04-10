<?php

namespace Modules\Core\Http\Controllers\Public;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Modules\Core\Http\Controllers\BaseWebController;

class HomeController extends BaseWebController
{
    public function index(): Factory|View|Application
    {
        return view('core::public.home');
    }
}
