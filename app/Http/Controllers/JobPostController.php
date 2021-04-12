<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\JobPost;
use App\Models\User;

class JobPostController extends Controller
{
    public function allJobs(){
        if(request()->has('search')){
            $search = request()->get('search');
            $jobs = JobPost::Where('title', 'like', '%'.$search.'%')
            ->paginate(10);
          }else{
            $jobs = JobPost::orderBy('created_at','desc')->paginate(10);
          }   
        return view('jobs')->with('jobs', $jobs);
    }

    public function showJob($id){
        $job = JobPost::find($id);
        $jobs = JobPost::where('category_id','=',$job->category_id)->paginate(3);
        return view('job-show')->with('job', $job)->with('jobs', $jobs);
    }

    
}
