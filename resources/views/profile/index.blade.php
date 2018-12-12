@extends('profile.master')
@section('content')
<div class="container py-4">

	<div class="row justify-content-center">
		<div class="col-md-12 col-md-offset-2">
			@foreach($userData as $uData)
			<div class="card">
				<div class="card-header">
					Timeline
				</div>
				<div class="card-body">
					<div class="row justify-content-center">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header text-center bg-info">
									<img src="{{$uData->pic}}" style="width: 250px; height: 250px; border-radius: 50%;">
								</div>
								<div class="card-body text-center">
									<h3>{{ucfirst($uData->name)}}</h3>
									<p>{{$uData->city}} - {{$uData->country}}</p>
									@if($uData->id == Auth::user()->id)
										<div class="row justify-content-center">
											<a href="/editProfile" class="btn btn-primary" role="button">Edit Profile</a>
											<a href="/changePhoto" class="btn btn-default" >Change Profile Picture</a>
										</div>
									
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<div class="col-md-12">
		<br>
		@foreach($posts as $post)

			@if(Auth::user()->id == $post->user->id)
			<p>{{Auth::user()->posts()->count()}} Posts created</p>
			@endif
			<div class="card mb-4">
				
			    <div class="card-header">
			        <div class="card-title">
			         <img src="{{$post->user->pic}}" style="width:70px;height: 70px; border-radius: 50%;"> {{$post->user->name}}</a>
			         <div class="pull-right">
			            <div class="dropdown">
			                <small>{{ $post->updated_at->diffForHumans() }}</small>
			                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded='false'>
			                    <span class="caret"></span>
			                </a>
			                <ul class="dropdown-menu" role="menu">
			                    <li><a href="{{ route('post.show', [$post->id]) }}">Show Post</a></li>
			                    
			                
			                </ul>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="card-body">
				<p>{{$post->body}}</p>
				@if($post->image != null)
				<img src="/{{$post->image}}" style="width: 100%; height: auto;">
				@endif
			</div>
			<div class="card-footer">
			    <a href="" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'}}</a> | 
                <a href="" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'}}</a>
                |
                <a href="{{ route('post.show', [$post->id]) }}">View comments</a>
			</div>
		</div>
		@endforeach
		
	</div>
</div>
@endsection