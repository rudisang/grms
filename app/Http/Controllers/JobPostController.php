<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\JobPost;
use App\Models\User;

class JobPostController extends Controller
{
    public function allJobs(){
        return 1;
    }

    public function showJob($id){
        $job = JobPost::find($id);

        return view('job-show')->with('job', $job);
    }
}
