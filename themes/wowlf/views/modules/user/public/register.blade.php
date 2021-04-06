@extends('layouts.master')

@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Register</h1>

                    <form action="{{ route('auth.register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@endif
                        </div>

                        <div class="form-group">
                            <label>Username<span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Your username">
                            @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label>Password<span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="A fucking secured password">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label>Password repeat<span class="text-danger">*</span></label>
                            <input type="password" name="password_repeat" class="form-control @error('password_repeat') is-invalid @enderror" placeholder="Repeat your password">
                            @error('password_repeat') <div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="btn btn-success font-weight-bold mr-2">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection()
