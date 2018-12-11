<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
use Session;

class PostController extends Controller{
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    public function edit($id)
    {
        $post = Post::find($id);
        if (Auth::user()->id != $post->user_id) {
            abort(404);
        }
        if ($post == null) {
            abort(404);
        }
        
        return view('posts.edit')->withPost($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (Auth::user()->id != $post->user_id) {
            abort(404);
        }
        if ($post == null) {
            abort(404);
        }
        $this->validate($request, [
            'body' => "required",
            'image' => 'nullable'
            ]);
        $post->body = $request->body;

         if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time(). "." . $image->getClientOriginalExtension();
            $destination = "images/";
            $image->move($destination,$image_name);
            $post->image = $destination.$image_name;
        }

        $post->user_id = Auth::user()->id;
       
        $post->save();

        Session::flash('success', 'Post was successfully updated');
        return redirect()->back();
    }
    
    public function destroy($id)
    {
        $post = Post::find($id);
        if (Auth::user()->id != $post->user_id) {
            abort(404);
        }
        if ($post == null) {
            abort(404);
        }
        $post->delete();
        Session::flash("success","Post successfully deleted.");
        return redirect('/home');
    }
    /* Post Create */
    
    public function postCreatePost(Request $request){

        // Validation
        $this->validate($request, [
           'body'   => 'required | min:5 | max:1000' 
        ]);

        $post = new Post();
        $post->body = $request['body'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time(). "." . $image->getClientOriginalExtension();
            $destination = "images/";
            $image->move($destination,$image_name);
            $post->image = $destination.$image_name;

        }

        $message = "Not Successfully Insert";
        if($request->user()->posts()->save($post)){
            $message = "Successfully Insert";
        }
       


        return redirect()->route('home')->with(['message' => $message]);
    }
    

    

    
    
    /* Post Like */
    
    public function postLikePost(Request $request){
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);
        if(!$post){
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if($like){
            $already_like = $like->like;
            $update = true;
            if($already_like == $is_like){
                $like->delete();
                return null;
            }
        }
        else{     
            $like = new Like();
        }
        
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        
        if($update){
            $like->update();
        }
        else{
            $like->save();
        }
        return null;
    }
}