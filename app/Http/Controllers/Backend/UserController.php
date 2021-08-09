<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$users = User::all();
		$roles = Role::all();
		if (Auth::check()) {
			return view('users.index', compact('users','roles'));
		}else{
			return view('auth\login');
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required',
			'email' => 'required|unique:users',
			'role_id' => 'required'
		]);
		
		$user = new User;
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->role_id = $request->input('role_id');
		$user->password = Hash::make('password');
		
		$user->save();
		
		if (Auth::check()) {
			return redirect('users')->with('success','User Successfully Saved!');
		}else{
			return view('auth\login');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		if (Auth::check()) {
			$user = User::find($id)->get();
			return view('users.show',compact('user'));
		}else{
			return view('auth\login');
		}
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
        $this->validate($request, [
			'name' => 'required',
			'email' => 'required|unique:users',
			'role_id' => 'required'
		]);
		
		$input = $request->all();
		
		$user = User::find($id);
		
		$user->update($input);
		
		if (Auth::check()) {
			return redirect('users')->with('success','User Updated Successfully!');
		}else{
			return view('auth\login');
		}
    }
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatepassword(Request $request)
    {
        $this->validate($request, [
			'password' => 'required|confirmed'
		]);
		
		$input['password'] = Hash::make($request->input('password'));
		
		$user = User::find(Auth::id());
		
		$user->update($input);
	
		
		if (Auth::check()) {
			return redirect()->route('users.show',Auth::id())->with('success','User Password Updated Successfully!');
		}else{
			return view('auth\login');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
		if (Auth::check()) {
			return redirect('users')->with('success','User Deleted Successfully!');
		}else{
			return view('auth\login');
		}
    }
}
