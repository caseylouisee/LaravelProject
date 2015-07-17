<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Messenger\Messagable;


class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use EntrustUserTrait;
    use Authenticatable, CanResetPassword;
    use Messagable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'description'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
    
    public function getTagListAttribute()
    {
        return $this->tags->lists('id')->all();
    }
    
    public function jobs()
    {
        return $this->belongsToMany('App\Job')->withTimestamps();
    }
    
    public function ratings()
    {
        return $this->belongsToMany('App\Rating')->withTimestamps()->withPivot('rated_by');
    }
    
    public function bids() {
        return $this->belongsToMany('App\Job','bids')->withPivot('id','status','proposal');
    }
    
}
