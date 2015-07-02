<?php

namespace App\Http\Controllers\User;

use Auth;
use DB;
use Illuminate\Http\Request;
use App\User;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{		
	/**
	 * Instantiate a new UserController instance.
	 *
	 * @return void
	 */
	public function __construct(User $user)
	{
		//$this->user = $user;
		// if you add this then profile pages can only be viewed by users
		//$this->middleware('auth');
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
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request, User $user)
	{
		return view('users.show', compact('user'));
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showMyProfile(Request $request, User $user)
	{
		return view('users.showMyProfile', compact('user'));
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function profile($slug)
	{
		$user = User::where('slug', $slug)->first();
		return view('users.show', compact('user'));
	}

	
}