<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

use Auth;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getDashboard(){
    

        $id = Auth::id();
        
        $posts = Post::whereIn('user_id', function($query) use($id)
            {       
                   
                    $value = DB::table('friendships')->where('status', 1)->where('requester', $id)->value('user_requested');
                    // $value = DB::table('friendships')->where('status', 1)->where('user_requested', $id)->value('requester');
                
                    if ($value) {
                        $query->select('user_requested')
                        ->from('friendships')
                        ->where('requester', $id)
                        ->where('status', 1);
                       
                    }else{
                         $query->select('requester')
                        ->from('friendships')
                        ->where('user_requested', $id)
                        ->where('status', 1);
                    }
                    // dd($value);
                    
            })
                ->orWhere('user_id', $id)->latest()->get();




        return view('home')->withPosts($posts);
    }
}
