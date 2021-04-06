@extends('layouts.master')

@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Login</h1>

                    <form action="{{ route('auth.login') }}" method="POST">
                        @csrf
                        <label>
                            <input name="email" type="email" value="{{ old('email') }}" required>
                        </label>
                        <label>
                            <input name="password" type="password" required>
                        </label>
                        <button type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection()
