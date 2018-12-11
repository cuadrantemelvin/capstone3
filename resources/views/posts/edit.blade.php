@extends('profile.master')
@section('content')
<div class="container py-4">
	<div class="row justify-content-around">
		<div class="col-lg-8">
			@if(Session::has('success'))
			<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				{{Session::get('success')}}
			</div>
			@endif
			<form method="POST" action="/post/{{$post->id}}/update" enctype="multipart/form-data">
				{{csrf_field()}}
				{{method_field("PATCH")}}
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							<img src="{{$post->user->pic}}" style="width: 30px; height: 30px;"> {{$post->user->firstname}} {{$post->user->lastname}}
							<div class="pull-right">
								<div class="dropdown">
									<small>{{ $post->updated_at->diffForHumans() }}</small>
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded='false'>
										<span class="caret"></span>
									</a>
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('post.edit', [$post->id]) }}">
                                           Edit Post
                                        </a>
                                        <a class="dropdown-item" data-toggle="modal" data-target="#confirmDelete">
                                            Delete
                                        </a>
                                    </div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="form-group" style="margin-bottom: 5px;">
							<textarea id="body" name="body" rows="5" class="form-control">{{$post->body}}
							</textarea>
							<div class="btn btn-primary btn-sm ">
	                            <input type="file" name="image">
	                        </div>
							@if($errors->has('body'))
							<small class="text-danger">{{$errors->first('body')}}</small>
							@endif
							<button class="btn btn-primary my-1">Update Post</button>
							@if ($post->image != null)
								<img src="/{{ $post->image }}" width="100%" height="auto">
							@endif
						</form>
					</div>

				</div>
			</div>
		</form>
	</div>
</div>
@endsection