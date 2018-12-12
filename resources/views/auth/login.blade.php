@extends('profile.master')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div style="margin: 20px 0 25px 0">
                        <div class="jumbotron text-center bg-info">
                            <h3 class="text-dark">Log In Your Account!</h3>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="Enter Email Address" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Enter Password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="d-block">
                            <button type="submit" class="btn btn-primary" id="login">Login</button>
                            <a href="{{ route('register') }}">Don&apos;t have account? Sign Up!</a>
                        </div>
                    </form>
                </div>                 
            </div>
        </div>
    </div>
</div>
@endsection
