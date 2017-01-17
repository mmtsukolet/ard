<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function index(){ //Get all records from users table
    	return User::orderBy('id','desc')->get();
    }
    public function show($id){ //Get a single record by ID
    	return User::find($id); 
    }

    public function store(Request $request){ //Insert new record to users table	

    	$this->validate($request, [
	        'email' 	=> 'required|unique:users',
	        'password'	=> 'sometimes',
	        'name'		=> 'required',
	        'phone'		=> 'required'
	    ]); 

		$user 				= new User;
		$user->email 		= $request->input('email');
		$user->password 	= Hash::make( $request->input('password') );
		$user->name 		= $request->input('name');
		$user->address 		= $request->input('address');
		$user->phone 		= $request->input('phone');
		$user->save();
		return 'Success adding new user';
	}

    public function update(Request $request, $id){ //Update a record
    	$this->validate($request, [
	        'email' 	=> 'required',
	        'password'	=> 'sometimes',
	        'name'		=> 'required',
	        'address'	=> 'required',
	        'phone'		=> 'required'
	    ]); 
		$user 				= User::find($id);
		$user->email 		= $request->input('email');
		if($request->has('password')){
			$user->password = Hash::make( $request->input('password') );
		}
		$user->name 		= $request->input('name');
		$user->address 		= $request->input('address');
		$user->phone 		= $request->input('phone');
		$user->save();
		return "Sucess updating user #" . $user->id;
	}

    public function destroy(Request $request){ //Delete a record
    	$this->validate($request, [
	        'id' => 'required|exists:users'
	    ]);
		$user = User::find($request->input('id'));
		$user->delete();
		return "Success deleting user #".$request->input('id');
    }
}
