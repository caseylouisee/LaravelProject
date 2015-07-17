<?php

namespace App\Http\Controllers\User;

use Auth;
use DB;
use Validator;
use Redirect;
use Illuminate\Http\Request;
use App\User;
use App\Tag;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Image;


class UserController extends Controller
{		
	/**
	 * Instantiate a new UserController instance.
	 *
	 * @return void
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
		// if you add this then profile pages can only be viewed by users
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request, User $user)
	{		 
		return view('users.index')->with('user',$user);
	}	
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexSort(Request $request, User $user)
	{		 
		$user = User::orderBy('name', 'ASC');
		return view('users.index')->with('user',$user);
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  Request $request, User $user
	 * @return Response
	 */
	public function showMyProfile(Request $request, User $user)
	{
		return view('users.showMyProfile', compact('user'));
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  $slug
	 * @return Response
	 */
	public function showProfile($id)
	{
		$user = User::where('id', $id)->first();
		return view('users.showProfile', compact('user'));
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  $slug
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::where('id', $id)->first();
		if(Auth::user()->id == $user->id){
			$tags = Tag::lists('name','id');
			return view('users.edit', compact('user','tags'));
		} else {
			return redirect('users/myProfile')->with('alert','You do not have permission to edit this profile.');
		}
	}
	
	public function update(Request $request, $id)
	{
		$input = array_except(Input::except('_token','tag_list'), '_method');
		$user = User::where('id', $id)->first();
		$user->update($input);
		
		$authUser = Auth::user();
		
		$tags = (array) $request->input('tag_list'); 
		$this->syncTags($authUser, $tags);
		
		
		if($request->hasFile('image')){
			$file = Input::file('image');
			$imageName = $user->id . '.' . 'jpg';
			$image = Image::make($file->getRealPath())->fit(240,240)->save(public_path('/images/profiles/'.$imageName));
		}	
		return redirect('users/myProfile')->with('message', 'Profile updated.');
	}
	
	public function syncTags(User $user,array $tags)
	{
		$user->tags()->sync($tags);
	}
	
}