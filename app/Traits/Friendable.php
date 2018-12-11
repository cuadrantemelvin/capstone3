<?php 

namespace App\Traits;
use App\Friendship;


trait Friendable{
	public function test(){
		return 'hi';
	}
	public function addFriends($user_id){
		$friendship = Friendship::create([

			'requester' => $this->id,
			'user_requested' => $user_id,

		]);
		if ($friendship) {
			return $friendship;
		}
		return 'failed';

	}
}