@extends('profile.master')

@section('content')

<div class="container py-4">

    <div class="row">



        <div class="col-md-12">
            <div class="card">
             
                <div class="card-header">
                    <div class="col-sm-12 col-md-12">
                        <div class="thumbnail text-center">
                            <div>
                                <img src="{{Auth::user()->pic}}" width="150px" height="150px" class="text-center"/> 
                            </div>
                            <h3 align="center">{{ucwords(Auth::user()->name)}}</h3>

                            <p align="center">{{Auth::user()->profile->city}} - {{Auth::user()->profile->country}}</p>
                            <p align="center">  <a href="{{url('/')}}/changePhoto"  class="btn btn-primary" role="button">Change Image</a></p>
                        </div>
                    </div>
                   </div>
                   
                    <div class="col-sm-12 col-md-12">


                        <form action="{{url('/updateProfile')}}" method="post">
                           {{csrf_field()}}
                           <div class="row justify-content-center">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <span  id="basic-addon1">City Name</span>
                                    <input type="text" class="form-control" placeholder="City Name" name="city" value="{{Auth::user()->profile->city}}">
                                </div>
                             
                                <div class="form-group">
                                    <span  id="basic-addon1">Country Name</span>
                                    <input type="text" class="form-control" placeholder="Country Name" name="country" value="{{Auth::user()->profile->country}}">
                                </div>

                                <div class="form-group">
                                    <span  id="basic-addon1">About</span>
                                    <textarea type="text" class="form-control" placeholder="Tell something here..." name="about">{{Auth::user()->profile->about}}</textarea>
                                    <input type="submit" class="btn btn-success" >
                                </div>
                                 
                            </form>

                        </div>


                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
