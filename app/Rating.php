<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
	
	protected $fillable = ['rating', 'comment'];
	
	public function users(){
		return $this->belongsToMany('App\User')->withTimestamps()->withPivot('rated_by');
	}

}
