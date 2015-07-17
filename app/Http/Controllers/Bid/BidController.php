<?php

namespace App\Http\Controllers\Bid;
use Illuminate\Http\Request;

use Input;
use Validator;
use Redirect;
use App\User;
use App\Bid;
use App\Job;
use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BidController extends Controller
{
		
	/**
	 * Instantiate a new UserController instance.
	 *
	 * @return void
	 */
	public function __construct(Bid $bid)
	{
		$this->bid = $bid;
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
		if(Auth::user()->hasRole('Manager')){
			return Redirect::to('/jobs/'.$id)->with('alert', 'You are not allowed to bid on jobs');
		} else {
			return view('bids.create')->with('id',$id);
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
			'proposal' => 'required',
		);
		
		$validator = Validator::make(Input::all(), $rules);
		
		$jobid = Input::get('jobid');
		// process the login
		if ($validator->fails()) {
			return Redirect::to('/jobs/'.$id)->with('alert', $messages);

		} else {
			$user = Auth::user();
			
			$bid = new Bid;
			$bid->user_id = $user->id;
			$bid->job_id = $jobid;
			$bid->proposal=Input::get('proposal');
			$bid->save();

			// redirect
			return Redirect::to('/jobs/'.$jobid)->with('message', 'Successfully bid!');
		}
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  $id
	 * @return Response
	 */
	public function edit($bidid, $userid, $jobid)
	{
		$bid = Bid::where('id', $bidid)->first();
		$user = User::where('id',$userid)->first();
		$job = Job::where('id',$jobid)->first(); 
	
		$job->bidding = ('Closed');
		$job->save();

		
		$result = $user->bids()->where('bids.id', $bidid)->first();
		$result->pivot->update(['status'=>'Accepted']);

		//$count = Bid::where('job_id', '=', $jobid)->count();
		
		foreach (User::all() as $users){
			foreach($users->bids()->where('jobs.id', $jobid)->get() as $bid) {
				if($bid->pivot->status == 'Pending'){
					$bid->pivot->update(['status'=>'Declined']);
				}
			}	
		}	
		//$user->bids()->where('bids.job_id',$jobid)->first()->pivot->update(['status'=>'Declined']);
		
		if(Auth::user()->hasRole('Manager')){
			return Redirect::to('/manage')->with('message', 'You have accepted this bid for job' . $jobid);
		} else {
			return Redirect::to('jobs')->with('alert', 'You do not have permission to edit this job');
		}
	}

}	
