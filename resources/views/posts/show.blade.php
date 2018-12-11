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
		
            <div class="card">
                <div class="card-header bg-info">
                    
                       <img src="{{ $post->user->pic }}" style="width: 50px; height: 50px; border-radius: 50%;"> {{$post->user->name}} {{$post->user->lastname}}
                      
                       <div class="pull-right">
                             @if(Auth::user()->id == $post->user->id)
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
                            @else

                    @endif
                    </div>
            </div>

            <div class="card-body">
                <p>{{$post->body}}</p>
                @if ($post->image != null)
                    <img src="/{{$post->image}}" width="100%" height="auto">
                @endif
            </div>
             <div class="card-footer interaction bg-light">
                            
                <a href="" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'}}</a> | 
                <a href="" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'}}</a>
                            |
                <a href="{{ route('post.show', [$post->id]) }}">View comments</a>
            </div> 
            @foreach($post->comments as $comment)
                    <div class="card" style="border-radius: 0;">
                        <div class="card-body pb-0">
                            
                                <img src="{{$comment->user->pic}}" style="width: 50px; height: 50px; border-radius: 50%; margin: 5px;"> 
                                <span><strong>{{$comment->user->name}}</strong> {{$comment->comment}}</span>
                            
                            
                            <div class="pull-right">
                                <!-- <small>Comment by {{$comment->user->username}}</small> -->
                                <small>{{ $comment->updated_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>

                    @endforeach
              
            @if (Auth::check())
            <div class="card" style="border-radius: 0;">
                <div class="card-body">
                    <form action="/comment" method="POST" style="display: flex;">
                        {{csrf_field()}}
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <textarea type="text" name="comment" placeholder="Comment here" class="form-control" style="border-radius: 0;"> </textarea>
                        <button type="submit" class="btn btn-primary" style="border-radius: 0;">Comment</button>
                    </form>
                    @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <ul>
                            @foreach($errors->all() as $error)
                                {{$error}}
                            @endforeach
                        </ul>
                    </div>
                    @endif
                   
                </div>
            </div>
            @endif
              
        
        </div>

	</div>

    <div id="confirmDelete" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <p>Do you want to delete post?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="/post/{{$post->id}}/delete">
                        {{csrf_field()}}
                        {{method_field("DELETE")}}
                        <button type="submit" class="btn btn-primary">Confirm</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </form>

                    
                </div>
            </div>
        </div>
    </div>
	
</div>
@endsection