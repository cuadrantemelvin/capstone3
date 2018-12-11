@extends('profile.master')
@section('content')
<div class="background-main py-5 text-center text-white align-items-center d-flex">
    <div class="container py-5"></section>
      <div class="row">
        <div class="mx-auto col-lg-8 col-md-10">
          <h1 class="display-4 mb-4 text-primary">Welcome to FriendBits!</h1>
          <p class="lead mb-5">Tell them your story with your friends. Like, Post and Comment!</p> 
          <a href="{{ route('login') }}" class="btn btn-lg btn-primary mx-1" >Login</a>
          <a href="{{ route('register') }}" class="btn btn-lg btn-outline-primary">Join Now!</a> 
        </div>
      </div>
    </div>
  </div>
@endsection
