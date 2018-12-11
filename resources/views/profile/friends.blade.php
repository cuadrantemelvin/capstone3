@extends('profile.master')
@section('content')
<div class="container py-4">
	
	<div class="row justify-content-center">
		<div class="col-md-12 col-md-offset-2">
			 @if ( session()->has('msg') )
               <div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					{{ session()->get('msg') }}
				</div>
                  
               </p>
           	 @else
             @endif
			<div class="card">
				<div class="card-header">Friend Lists</div>
				<div class="card-body">
					<div class="row">
						@foreach($friends as $uList)
						<div class="col-md-3">
							<div class="card h-100">
								<div class="card-header">
									<img src="{{$uList->pic}}" style="width: 200px; height: auto;">
								</div>
								<div class="card-body text-center">
									<h4><a href="{{url('/profile')}}/{{$uList->slug}}">{{$uList->name}}</a></h4>
	                                     <p>
	                                        <a href="/unfriend/{{$uList->id}}"  class="btn btn-danger btn-sm">Unfriend</a>
	                                    </p>
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