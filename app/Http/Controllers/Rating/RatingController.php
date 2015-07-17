<?php

namespace App\Http\Controllers\Rating;
use Illuminate\Http\Request;

use Input;
use Validator;
use Redirect;
use App\Rating;
use App\User;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RatingController extends Controller
{
		
	/**
	 * Instantiate a new UserController instance.
	 *
	 * @return void
	 */
	public function __construct(Rating $rating)
	{
		$this->rating = $rating;
		// if you add this then job pages can only be viewed by users
		//$this->middleware('auth');
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$user = User::find($id);
		if(!Auth::user()){
			return Redirect::to('/auth/login')->with('alert', 'You do not have permission to create a review, please login');
			
		}else if(Auth::user()->hasRole('Developer')){
			return Redirect::to('users')->with('alert', 'You do not have permission to create a review');
			
		}else if(Auth::user()->id==$id){
			return Redirect::to('/manage')->with('alert', 'You cannot rate yourself');
			
		} else if($user->hasRole('Manager')){
			return Redirect::to('/manage')->with('alert', 'You cannot rate a manager');
			
		} else if(Auth::user()->hasRole('Manager')){
			return view('ratings.create')->with('id',$id);
		}
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'rating' => 'required|integer',
			'comment' => 'required',
		);
		
		$validator = Validator::make(Input::all(), $rules);
		
		$id = Input::get('userid');
		// process the login
		if ($validator->fails()) {
			$messages = $validator->messages();
			return Redirect::to('/users/'.$id)->with('alert', $messages);
				
		} else if(Auth::user()->id == $id){
			return Redirect::to('/users')->with('message','You cannot rate yourself');
			
		} else {
			$user = User::find($id);
			
			$rating = new Rating;
			$rating->rating = Input::get('rating');
			$rating->comment = Input::get('comment');
			$rating->save();
			
			$user->ratings()->attach($rating, array('rated_by' => Auth::user()->id));

			// redirect
			return Redirect::to('/users/'.$id)->with('message', 'Successfully created rating!');
		}
	}

}	
