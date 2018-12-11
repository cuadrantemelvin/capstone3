@extends('profile.master')

@section('title')
    Dashboard
@endsection

@section('content')
   
    <section class="row new-post py-4">
        <div class="col-md-6 offset-md-3">
             @include('includes.error-message')
             @include('includes.success-message')
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="text-light">Write a post</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('post.create') }}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group" style="margin-bottom: 5px;">
                            <textarea name="body" class="form-control" id="body" rows="4" placeholder="Tell something here ..."></textarea>
                        </div>
                     
                        <div class="btn btn-primary btn-sm ">
                            <input type="file" name="image">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit Post</button>
                    </form>
                </div>
                
            </div>
            
        </div>
    </section>
 
    <section class="row posts">
        <div class="col-md-6 offset-md-3">
            
                

                    @foreach($posts as $post)

                        <div class="card post mt-4" data-postid="{{$post->id }}">
                            <div class="card-header bg-info">
                                
                                 <img src="{{ $post->user->pic }}" class="img-fluid" style="width: 50px; height: 50px; border-radius: 50%;"> {{ $post->user->name }} 
                               
                                <div class="pull-right">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded='false'>
                                            <span class="caret text-dark"></span>
                                        </a>
                                        <div class="dropdown-menu" role="menu">
                                            <a href="{{ route('post.show', [$post->id]) }}" class="dropdown-item">Show Post</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <p>{{ $post->body }}</p>
                                @if ($post->image != null)
                                <img src="{{$post->image}}" style="width:100%; height: auto;">

                                @endif
                                <small>Posted {{ $post->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="card-footer interaction bg-light">
                            
                                <a href="" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'}}</a> | 
                                <a href="" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'}}</a>
                                |
                                <a href="{{ route('post.show', [$post->id]) }}">View comments</a>
                            </div>  
                        
                     
               

            </div>
          
         @endforeach

    </section>
 

   

    
        
@endsection