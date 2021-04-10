<?php

namespace Modules\User\Http\Controllers\Public;

use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Modules\Core\Http\Controllers\BaseWebController;
use Modules\User\Http\Requests\LoginRequest;
use Modules\User\Http\Requests\RegisterRequest;

class AuthController extends BaseWebController
{
    public function getLogin(): Factory|View|Application
    {
        return view('user::public.login');
    }

    public function postLogin(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only(['email', 'password']);
        $remember = (bool)$request->get('remember_me', false);

        $redirectError = redirect()
            ->back()
            ->withInput();

        try {
            if (false === sentinel()->authenticate($credentials, $remember)) {
                return $redirectError->with('error', trans('user::messages.authentication.invalid_credentials'));
            }
        } catch (NotActivatedException $exception) {
            return $redirectError->with('error', trans('user::messages.authentication.not_activated'));
        } catch (ThrottlingException $exception) {
            return $redirectError->with(
                'error',
                trans('user::messages.authentication.blocked', ['delay' => $exception->getDelay()])
            );
        }

        return redirect()
            ->intended(route(config('wowlf.user.config.redirect_route_after_login')))
            ->with('success', trans('user::messages.authentication.success'));
    }

    public function getRegister(): Factory|View|Application
    {
        return view('user::public.register');
    }

    public function postRegister(RegisterRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $user = sentinel()->registerAndActivate($request->all());
            DB::commit();
        } catch (\InvalidArgumentException $exception) {
            DB::rollBack();

            return redirect()
                ->route('register')
                ->with('error', trans('user::messages.registration.failed'));
        }

        return redirect()
            ->route('login')
            ->with('success', trans('user::messages.registration.success'));
    }

    public function postForgotPassword()
    {

    }

    public function getLogout(): RedirectResponse {

        sentinel()->logout();

        return redirect()
            ->intended(route(config('wowlf.user.config.redirect_route_after_logout')))
            ->with('success', trans('user::messages.logout.success'));
    }
}
