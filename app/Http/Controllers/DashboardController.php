<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function assignRole(Request $request){

        $user = User::find(auth()->user()->id);
        $user->role_id = intval($request->input('role'));
        $user->save();

        return redirect('/dashboard')->with('success', 'Almost there, Just a few more steps and your account will be ready');

    }

    public function SelectAccount(){
        $roles = Role::all();

        if(Auth::user()->role_id){
            return view('dashboard.index');
    
        }else{
            return view('dashboard.select-account')->with('roles', $roles);
        }
    }

    public function index()
    {
        $roles = Role::all();
        if(Auth::user()->role_id){
            return view('dashboard.index');
    
        }else{
            return view('dashboard.select-account')->with('roles', $roles);
    
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
