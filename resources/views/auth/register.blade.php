@extends('profile.master')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf


                        <div style="margin: 20px 0 25px 0">
                        <div class="jumbotron text-center bg-info">
                            <h3 class="text-dark">Register Here!</h3>
                        </div>
                        <div class="form-group">
                            <label for="email">Name</label>
                           <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Gender</label><br>
                            <select name="gender" class="col-md-4 col-form-label" >
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Email</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label><br>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                             <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Register</button>
                            <a href="{{ route('login') }}">Already have account? Sign in here</a>   
                            
                        </div>

                  
                  

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




