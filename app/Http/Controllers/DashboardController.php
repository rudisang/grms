<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Role;
use App\Models\User;
use App\Models\Company;
use App\Models\JobPost;
use App\Models\Category;
use App\Models\Attachment;
use App\Models\Application;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['searchCompany']]);
    }

    public function searchCompany(Request $request){

        if(request()->has('search')){
            $search = request()->get('search');
            $companies = Company::Where('name', 'like', '%'.$search.'%')
            ->paginate(20);
          }else{
            $companies = Company::orderBy('created_at','desc')->paginate(20);
          }          
        
        return view('/companies')->with('companies', $companies);

    }

    public function assignRole(Request $request){

        $user = User::find(auth()->user()->id);
        $user->role_id = intval($request->input('role'));
        $user->save();

        return redirect('/dashboard')->with('success', 'Almost there, Just a few more steps and your account will be ready');

    }

    public function SelectAccount(){
        $roles = Role::all();
        $users = User::all();

        if(Auth::user()->role_id){
            return view('dashboard.index');
    
        }else{
            return view('dashboard.select-account')->with('roles', $roles)->with('users', $users);
        }
    }

    
    public function editUser($id){
        $user = User::find($id);

        // Check for correct user
        if(auth()->user()->role_id !== 3){
            return redirect('/dashboard')->with('error', 'Access Denied');
        }

        return view('/dashboard.edit-users')->with('user', $user);
    }

    public function editAccount(){
        return view('dashboard.edit-account');
    }

    public function updatePassword(Request $request, $id){
        $user = User::find($id);

        $oldpass = $request->old_pass;
        $newpass = $request->new_pass;
        $confpass = $request->conf_pass;

        if (Hash::check($oldpass, $user->password)) {
            if($newpass == $confpass){
                $request->validate([
                    'new_pass' => 'required|string|min:6',
                    'conf_pass' => 'required|string|min:6',
                    'old_pass' => 'required|string|min:6',
                ]);

                $user->password = Hash::make($request->new_pass);
                $user->save();
                return back()->with("success", "Awesome! Password Updated");

            }else{
                return back()->with("error", "New Password & Confirm Password Don't Match");
            }
        }else{
            return back()->with("error", "The password you entered does not match your current password");

        }


    }

    public function updateDetails(Request $request, $id){
        
       $limit = date("2003-12-30");
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'age' => 'required|date|before:'.$limit,
            'mobile' => 'required',
            'role_id' => 'required',
        ]);

		$user = User::find($id);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->mobile = $request->mobile;
        $user->role_id = intval($request->role_id);
            
        $user->save();
        return back()->with("success", "Details Updated Successfully");

    }


    public function deleteUser($id){
       
		$user = User::find($id);
      
        $user->delete();
 
        return redirect('/dashboard')->with("success", "User ".$user->name." ".$user->surname." was successfully Deleted");

    }

    public function createCompany()
    {
        if(Auth::user()->role_id != 2){
            return back()->with('error', 'You can not view this page');
        }else{
            return view('dashboard.create-company');
        }


    }

    public function editCompany($id)
    {
        if(Auth::user()->role_id != 2){
            return back()->with('error', 'You can not view this page');
        }else{
            $company = Company::find($id);
            return view('dashboard.edit-company')->with('company',$company);
        }


    }

    public function updateCompany(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'physical_address' => 'required|string|max:255',
            'postal_address' => 'required|string|max:255',
            'phone' => 'required',
            'bio' => 'required',
        ]);

        if($request->hasFile('logo')){
            $request->validate([
                'logo' => 'image|max:1999',
            ]);
            $logo = $request->logo->getClientOriginalName().time().'.'.$request->logo->extension();  
            $request->logo->move(public_path('logos'), $logo);
        }

        if($request->hasFile('cover')){
            $request->validate([
                'cover' => 'image|max:1999',
            ]);
            $cover = $request->cover->getClientOriginalName().time().'.'.$request->cover->extension();  
            $request->cover->move(public_path('covers'), $cover);
        } 

        $account = Company::find($id);

        $account->name = $request->name;
        $account->email = $request->email;
        $account->physical_address = $request->physical_address;
        $account->postal_address = $request->postal_address;
        $account->phone = $request->phone;
        $account->bio = $request->bio;
        if($request->hasFile('logo')){
            $account->logo = $logo;
        }
        if($request->hasFile('cover')){
            $account->cover = $cover;
        }
        

        $account->save();

        return redirect('/dashboard')->with('success', 'Company Account Updated');

    }


    public function storeCompany(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:companies',
            'logo' => 'image|max:1999',
            'cover' => 'image|max:1999',
            'physical_address' => 'required|string|max:255',
            'postal_address' => 'required|string|max:255',
            'phone' => 'required',
            'bio' => 'required',
        ]);

        if($request->hasFile('logo')){
            $logo = $request->logo->getClientOriginalName().time().'.'.$request->logo->extension();  
            $request->logo->move(public_path('logos'), $logo);
        } else{
            $logo = "no_image.png";
        }

        if($request->hasFile('cover')){
            $cover = $request->cover->getClientOriginalName().time().'.'.$request->cover->extension();  
            $request->cover->move(public_path('covers'), $cover);
        } else{
            $cover = "no_cover.jpg";
        }

        $account = new Company;

        $account->name = $request->name;
        $account->email = $request->email;
        $account->physical_address = $request->physical_address;
        $account->postal_address = $request->postal_address;
        $account->phone = $request->phone;
        $account->bio = $request->bio;
        $account->cover = $cover;
        $account->logo = $logo;
        $account->verified = 0;
        $account->user_id = auth()->user()->id;

        $account->save();

        return redirect('/dashboard')->with('success', 'Account Created');

    }

    public function index()
    {
        $roles = Role::all();
        $categories = Category::all();
        //$jobposts = JobPost::find();
        if(Auth::user()->role_id){
    
            return view('dashboard.index');
    
        }else{
            return view('dashboard.select-account')->with('roles', $roles);
    
        }

    }


    /********************************************************************
     * JOB POST FUNCTIONS
     ********************************************************************
     */
    public function createJobPost()
    {
        $categories = Category::orderBy('name','asc')->get();
        return view('dashboard.create-job-post')->with('categories',$categories);
    }

    public function storeJobPost(Request $request)
    {
        $request->validate([
        'title'  => 'required|string|max:255',
        'category_id'  => 'required',
        'position' => 'required|string|max:255',
        'details' => 'required',
        'deadline' => 'required|date|after:today',
        ]);

        $job = new JobPost;
        $job->company_id = auth()->user()->company->id;
        $job->title = $request->title;
        $job->category_id = intval($request->category_id);
        $job->position = $request->position;
        $job->deadline = $request->deadline;
        $job->details = $request->details;
        
        $job->save();

        return redirect('/dashboard')->with('success','New Job Post Added');
    }

    public function editJobPost(Request $request, $id)
    {
        $request->validate([
        'title'  => 'required|string|max:255',
        'category_id'  => 'required',
        'position' => 'required|string|max:255',
        'details' => 'required',
        'deadline' => 'required|date|after:today',
        ]);

        $job = JobPost::find($id);
        $job->title = $request->title;
        $job->category_id = intval($request->category_id);
        $job->position = $request->position;
        $job->deadline = $request->deadline;
        $job->details = $request->details;
        
        $job->save();

        return redirect('/dashboard')->with('success','Job Post Updated');
    }

    public function storeJobCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        $cat = new Category;
        $cat->name = $request->name;

        $cat->save();

        return back()->with('success','Category Added');
    }

    public function editJobCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $cat = Category::find($id);
        $cat->name = $request->name;

        $cat->save();

        return back()->with('success','Success');
    }

    public function createProfile()
    { 
     return view('/dashboard.create-profile');
    }

    public function storeProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        $cat = new Category;
        $cat->name = $request->name;

        $cat->save();

        return back()->with('success','Category Added');
    }

    public function storeAttachment(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'attachment' => 'required|image|max:1999',
        ]);

        if($request->hasFile('attachment')){
            $attachment = $request->attachment->getClientOriginalName().time().'.'.$request->attachment->extension();  
            $request->attachment->move(public_path('documents'), $attachment);
        }

        $att = new Attachment;
        $att->title = $request->title;
        $att->attachment = $attachment;
        $att->user_id = Auth::user()->id;
        $att->save();

        return back()->with('success','New Attachment Added');
    }

    public function updateAttachment(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'attachment' => 'image|max:1999',
        ]);

        if($request->hasFile('attachment')){
            $attachment = $request->attachment->getClientOriginalName().time().'.'.$request->attachment->extension();  
            $request->attachment->move(public_path('documents'), $attachment);
        }

        $att = Attachment::find($id);
        $att->title = $request->title;
        if($request->hasFile('attachment')){
        $att->attachment = $attachment;
        }
    
        $att->save();

        return back()->with('success','Attachment Updated');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function applyForm($id)
    {

        $jobpost = JobPost::find($id);
        return view('/dashboard.apply')->with('jobpost',$jobpost);
    }

    public function viewApplications($id)
    {
        $jobpost = JobPost::find($id);
      
        if(Auth::user()->id != $jobpost->company->user->id){
            return back();
        }else{
            return view('/dashboard.applications')->with('jobpost',$jobpost);
        }
        
    }

    public function apply(Request $request, $id)
    {
        $request->validate([
            'cover' => 'required',
        ]);

        $jobpost = JobPost::find($id);

        $app = new Application;
        $app->user_id = Auth::user()->id;
        $app->job_post_id = $jobpost->id;
        $app->cover = $request->cover;
        $app->status = 0;
dd($app->post);
        $app->save();
        return redirect('/dashboard')->with('success','Application Submitted. Good Luck 😃😃!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
