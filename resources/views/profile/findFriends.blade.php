@extends('profile.master')
@section('content')
<div class="container">
	
	<div class="row justify-content-center py-4">
		<div class="col-md-12 col-md-offset-2">
			<div class="card">
				<div class="card-header">
					<p>People You May Know</p>
				</div>
				<div class="card-body">
					<div class="row">
						@foreach($allUsers as $uList)
						<div class="col-md-3 mb-4">
							<div class="card h-100">
								<div class="card-header text-center">
									<img src="{{$uList->pic}}" style="width: auto; height: 100px; border-radius: 50%;"><br>
								</div>
								<div class="card-body text-center">
									<h4><a href="{{url('/profile')}}/{{$uList->slug}}">{{$uList->name}}</a></h4>
									<p>{{$uList->city}}</p>
								</div>
								<div class="card-footer text-center">
									<?php  
										  $check = DB::table('friendships')
			                                        ->where('user_requested', '=', $uList->id)
			                                        ->where('requester', '=', Auth::user()->id)
			                                        ->first();
			                                
			                                if($check ==''){
			                                ?>	
											<a class="btn btn-info" href="{{url('/addFriends/')}}/{{$uList->id}}">Add Friend</a>
										<?php } else {?>
                                    		<p class="alert alert-success">Request Already Sent</p>
                                <?php }?>
									
								</div>
							</div>
						</div>
							@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection