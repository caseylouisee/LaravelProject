<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
	
	protected $fillable = ['title', 'description'];
	
	public function users(){
		return $this->belongsToMany('App\User')->withTimestamps();
	}
	
	public function bids() {
		return $this->belongsToMany('App\User','bids')->withPivot('id','status','proposal');
	}

}
