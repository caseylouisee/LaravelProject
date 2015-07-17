<?php

namespace App\Http\Controllers\Tag;

use Illuminate\Http\Request;

use Input;
use Validator;
use Redirect;
use App\Tag;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
	
	/**
	 * Instantiate a new UserController instance.
	 *
	 * @return void
	 */
	public function __construct(Tag $tag)
	{
		$this->tag = $tag;
		// if you add this then job pages can only be viewed by users
		//$this->middleware('auth');
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::user()->hasRole('Manager')){
			return view('tags.create');
		}else{
			return Redirect::to('jobs')->with('alert', 'You do not have permission to create a tag');
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
			'name' => 'required',
		);
		
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('/manage')
				->withErrors($validator);
		} else {
			
			$tag = new Tag;
			$tag->name = Input::get('name');
			$tag->save();

			// redirect
			return Redirect::to('/manage')->with('message', 'Successfully created tag!');
		}
	}

	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($tag)
	{
		$tag= Tag::where('name', $tag)->first();
		$tag->delete();

		// redirect
		return Redirect::to('/manage')->with('message', 'Successfully deleted tag');
	}
}
