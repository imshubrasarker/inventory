<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Spatie\Permission\Models\Role;
use Hash;

class UsersController extends Controller
{
    public function index()
    {
    	$users = User::all();
    	$roles = Role::pluck('name','name');
    	return view('users.index',compact('users','roles'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
       $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
       ]);

       User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

       return redirect('/users')->with('success','Users Added!');
    }

    public function show($id)
    {
    	$user = User::find($id);
    	return view('users.show',compact('user'));
    }

    public function destroy(Request $request, $id)
    {
        $old_password = $request->password;
        $current_password = Auth::user()->password;
        if(Hash::check($old_password, $current_password))
        {
        	User::destroy($id);
        	$user = count(User::all());
        	if($user == 0){
        		return redirect('/login');
        	}else{
        		return redirect('/users')->with('success','User Deleted!');
        	}
        }else{
            return redirect('/users')->with('error','Password Not Matched!');
        }
    	
    }

    public function assignRole(Request $request)
    {
    	$id = $request->user_id;

    	$role = $request->role;

    	$user = User::findOrFail($id);
        // dd($user);
    	if($user){
    		$user->syncRoles($role);
    	}
    	return redirect()->back()->with('success','Assign Role Successfully');
    }

    public function passwordChangeView()
    {
        return view('users.password-change');
    }

    public function passwordChanged(Request $request)
    {
        $this->validate($request,[
            'old_password'      => ['required', 'string', 'min:8'],
            'new_password'      => ['required', 'string', 'min:8'],
            'confirm_password'  => ['required', 'string', 'min:8'],
        ]);
        $old_password       = $request->old_password;
        $new_password       = $request->new_password;
        $confirm_password   = $request->confirm_password;
        
        if(Auth::check()){
            if($new_password == $confirm_password){
                $current_password = Auth::user()->password;
                if(Hash::check($old_password, $current_password))
                {
                    $id             = Auth::user()->id;
                    $user           = User::findOrFail($id);
                    $user->password = Hash::make($new_password);
                    $user->save(); 
                    return redirect('/password-change')->with('success', 'Passowrd Updated!');
                }
            }else{
                return redirect('/password-change')->with('error','New Password and Confirm password not matching!');
            }
        }else{
            return redirect('/login');
        }
    }


    public function activeUser($id)
    {
       $user = User::where('id',$id)->first();
       $user->status = "1";
       $user->save();
       return redirect('users')->with('success','Status Updated!');
    }

    public function deactiveUser($id)
    {
       $user = User::where('id',$id)->first();
       $user->status = "0";
       $user->save();
       return redirect('users')->with('success','Status Updated!');
    }
}
