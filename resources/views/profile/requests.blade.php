@extends('profile.master')
@section('content')
<div class="container py-4">
	
	<div class="row justify-content-center">
		<div class="col-md-12">
			 @if ( session()->has('msg') )
               <div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					{{ session()->get('msg') }}
				</div>
                  
               </p>
           	 @else
             @endif
			<div class="card h-100">
				<div class="card-header">Friend Requests</div>
				<div class="card-body">
					<div class="row">
						@foreach($friend_requests as $uList)
						<div class="col-md-3">
							<div class="card">
								<div class="card-header">
									<img src="{{$uList->pic}}" style="width: 100%; height: auto;">
								</div>
								<div class="card-body">
									<h4><a href="{{url('/profile')}}/{{$uList->slug}}">{{$uList->name}}</a></h4>
	                                     <div class="row justify-content-center">
	                                        <a href="{{url('/accept')}}/{{$uList->name}}/{{$uList->id}}"  class="btn btn-info btn-sm">Confirm</a>

	                                        <a href="{{url('/requestRemove')}}/{{$uList->id}}"  class="btn btn-danger btn-sm">Remove</a>
	                                    </div>
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