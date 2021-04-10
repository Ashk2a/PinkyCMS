@extends('layouts.master')

@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>@lang('user::user.title.register')</h1>
                    <x-form action="{{ route('register.post') }}" method="POST">
                        <x-form-input type="email" name="email" :required="true" :label="@lang('user::user.email')" />
                        <x-form-input type="text" name="username" :required="true" :label="@lang('user::user.username')" />
                        <x-form-input type="password" name="password" :required="true" :label="@lang('user::user.password')" />
                        <x-form-input type="password" name="repeated_password" :required="true" :label="@lang('user::user.repeated_password')" />
                        <x-form-submit>@lang('user::user.btn.sign_up')</x-form-submit>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
@endsection()
