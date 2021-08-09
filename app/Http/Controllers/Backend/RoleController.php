<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class RoleController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if (Auth::check()) {
			$roles = Role::all();
			return view('roles.index', compact('roles'));
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
        return view('roles.create');
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
			'name' => 'required|unique:roles',
			'description' => 'required'
		]);
		
		$role = new Role;
		$role->name = $request->input('name');
		$role->description = $request->input('description');
		
		$role->save();
		
		if (Auth::check()) {
			return redirect('roles')->with('success','Role Created Successfully!');
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
        $role = Role::find($id);
        return response()->json([
	      'data' => $role
	    ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
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
			'name' => 'required|unique:roles',
			'description' => 'required'
		]);
		
		$input = $request->all();
		
		$role = Role::find($id);
		
		$role->update($input);
		
		
		if (Auth::check()) {
			return redirect('roles')->with('success','Role Updated Successfully!');
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
        
		if (Auth::check()) {
			
			$users = DB::table('users')->where('role_id', $id)->get();
			
			$usersCount = $users->count();
			
			if($usersCount==0){
				Role::find($id)->delete();
				return redirect('roles')->with('success','Role Deleted Successfully!');
			}else{
				return redirect('roles')->with('errorMsg','Cannot Delete Role!');
			}
			
		}else{
			return view('auth\login');
		}
    }
}
