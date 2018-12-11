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
						@foreach($notes as $note)
					
						
								<p><a href="{{url('/profile')}}/{{$note->slug}}" style="font-weight: bold; color: green;">{{$note->name}}</a> {{$note->note}}</p>
					
					
						@endforeach
							
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
@endsection