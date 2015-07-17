<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
	
	protected $fillable = ['proposal'];
	
	public function user(){
		return $this->hasOne('App\User','bids');
	}
	
	public function job(){
		return $this->hasOne('App\Job','bids');
	}

}
