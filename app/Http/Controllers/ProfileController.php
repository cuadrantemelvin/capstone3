<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Friendship;
use App\Notification;
use App\Post;
use App\User;


class ProfileController extends Controller
{
    public function index($slug){
    	$userData = DB::table('users')
            ->leftJoin('profiles', 'profiles.user_id','users.id')
            ->where('slug', $slug)
            ->get();
   
         return view('profile.index', compact('userData'))->with('data', Auth::user()->profile);

        dd($user->id);

    }

    public function changePhoto(){
    	return view('profile.pic');
    }

    public function uploadPhoto(Request $request){
    	$image = $request->file('pic');
    	$image_name = time(). "." . $image->getClientOriginalExtension();
    	$destination = "img/";
    	$image->move($destination,$image_name);

    	$user_id = Auth::user()->id;
    	$slug = Auth::user()->slug;

    	DB::table('users')->where('id', $user_id)->update(['pic'=>'/'.$destination.$image_name]);
    	return redirect()->route('profile', ['slug' => $slug]);

    }

    public function editProfile(){
    	return view('profile.editProfile');
    }

    public function updateProfile(Request $request) {

        $user_id = Auth::user()->id;

        DB::table('profiles')->where('user_id', $user_id)->update($request->except('_token'));
        return back();
    }


    public function findFriends(){
    	$uid = Auth::user()->id;
    	$allUsers = DB::table('profiles')->leftJoin('users','users.id', '=', 'profiles.user_id')->where('users.id','!=',$uid)->get();
    	return view('profile.findFriends', compact('allUsers'));
    }
    public function sendRequest($id){
    	 Auth::user()->addFriends($id);
    	 return redirect()->back();
    }

    public function requests(){
    	$uid = Auth::user()->id;
    	$friend_requests = DB::table('friendships')
    						->rightJoin('users', 'users.id', '=', 'friendships.requester')
    						->where('status', 0) //if status 0 then have request else 1 for i accepted
    						->where('friendships.user_requested', '=', $uid)->get();
    	return view('profile.requests', compact('friend_requests'));
    }

    public function accept($name, $id) {
         $uid = Auth::user()->id;
        $checkRequest = Friendship::where('requester', $id)
                ->where('user_requested', $uid)
                ->first();
        if ($checkRequest) {
            // echo "yes, update here";
    		 $updateFriendship = DB::table('friendships')
                    ->where('user_requested', $uid)
                    ->where('requester', $id)
                    ->update(['status' => 1]);

            $addNotif =   DB::table('friendships')
                    ->where('user_requested', $uid)
                    ->where('requester', $id)
                    ->update(['status' => 1]);

          	$notifications = new Notification;
            $notifications->note = 'accepted your friend request';
            $notifications->user_hero = $id; // who is accepting my request
            $notifications->user_logged = Auth::user()->id; // me 
            $notifications->status = '1'; // unread notifications 
            $notifications->save();

    		if ($notifications) {
    			return back()->with('msg', 'You are now friend with '.$name);
    		}
    	}else{
    		return back()->with('msg', 'You are now friend with this user');
    	}
    }
    public function friends(){
    	$uid = Auth::user()->id;
    	$friends1 = DB::table('friendships')
    				->leftJoin('users','users.id', 'friendships.user_requested')
    				->where('status',1)
    				->where('requester',$uid)
    				->get();// who send the request
    	$friends2 =DB::table('friendships')
    				->leftJoin('users','users.id', 'friendships.requester')
    				->where('status',1)
    				->where('user_requested',$uid)
    				->get(); // i sent request to which user

    	$friends = array_merge($friends1->toArray(), $friends2->toArray());

    	return view('profile.friends', compact('friends'));
    }

    public function requestRemove($id){
    	$uid = Auth::user()->id;

    	DB::table('friendships')
    	->where('user_requested',$uid)
    	->where('requester',$id)
    	->delete();

    	return back()->with('msg','Request has been deleted');
    }

    public function notifications ($id){
    	$uid = Auth::user()->id;
    	$notes = DB::table('notifications')
    		->leftJoin('users','users.id','notifications.user_logged')
    		->where('notifications.id', $id)
    		->where('user_hero',$uid)
    		->orderBy('notifications.created_at','desc')
    		->get();

    	$updateNotification = DB::table('notifications')
                    ->where('notifications.id', $id)
                    ->update(['status' => 0]);

    	return view('profile.notifications',compact('notes'));
    }
}
