@extends('layouts.master')

@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>@lang('user::user.title.login')</h1>
                    <x-form action="{{ route('login') }}" method="POST">
                        <x-form-input type="email" name="email" :label="@lang('user::user.email')" :required="true" />
                        <x-form-input type="password" name="password" :label="@lang('user::user.password')" :required="true" />
                        <x-form-submit>@lang('user::user.btn.login')</x-form-submit>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
@endsection()
