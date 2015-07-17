<?php

namespace App\Http\Controllers\Job;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\User;
use Validator;
use Input;
use Redirect;
use App\Job;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
        // if you add this then job pages can only be viewed by users
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $job = DB::table('jobs')->paginate(10);
        return view('jobs.index')->with('job',$job);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if(Auth::user()->hasRole('Manager')){
            return view('jobs.create');
        }else{
            return Redirect::to('jobs')->with('alert', 'You do not have permission to create a job');
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
            'title' => 'required',
            'description' => 'required',
        );
        
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('jobs/create')
                ->withErrors($validator);
        } else {
            // store
            $title = str_replace('.','',Input::get('title'));
            
            $job = new Job;
            $job->title = $title;
            $job->description = Input::get('description');
            $job->save();
            $job->users()->attach(Auth::user()->id);


            // redirect
            return Redirect::to('jobs')->with('message', 'Successfully created job!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $slug
     * @return Response
     */
    public function show($id)
    {
        $job = Job::where('id', $id)->first();
        return view('jobs.show')->with('job',$job);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return Response
     */
    public function edit($id)
    {
        $job = Job::where('id', $id)->first();
        
        if(Auth::user()->hasRole('Manager') && $job->users()->find(Auth::user()->id)){
            return view('jobs.edit')->with('job', $job);
        } else {
            return Redirect::to('jobs')->with('alert', 'You do not have permission to edit this job');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $job = Job::where('id', $id)->first();
        
        $rules = array(
            'title' => 'required',
            'description' => 'required',
        );
        
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('jobs/' . $id . '/edit')
                ->withErrors($validator);        
        } else {
            $job->title = Input::get('title');
            $job->description = Input::get('description');
            $job->bidding = Input::get('bidding');
            
            if(Input::has('bidding_checkbox')){
                $job->bidding = ('Open');
            } else {
                $job->bidding = ('Closed');
            }
            
            if(Input::has('status_checkbox')){
                $job->status = ('Complete');
            } else {
                $job->status = ('Uncomplete');
            }
            
            $job->save();
            
            return Redirect::to('/manage')->with('message','Successfully updated job!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $job= Job::where('id', $id)->first();

        if(Auth::user()->hasRole('Manager')&& $job->users()->find(Auth::user()->id)){
            // delete
            $job->delete();

            // redirect
            return Redirect::to('jobs')->with('message', 'Successfully deleted job');
        } else {
            return Redirect::to('jobs')->with('message', 'You do not have permission to delete a job');    
        }
    }
}
