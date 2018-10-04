<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ManageUser;

use Session;



class ManageUsersController extends Controller
{
    //
	    public function __construct(){

        $this -> middleware('auth'); 
        //this middelware allows only if you are signed in except for the index and show method

      }


	   public function show(){
	   		$users = ManageUser::where('is_admin','=',0) 
	   							->get();
	   		//gettting all user except admin
		return view('admins.manageuser',compact('users'));

	   }


	   
	   public function edit($id){
	   			//dd ($id);
		   	$users =ManageUser::where('id',$id)
		   						->select('id','name','status')->get();

		   		//Session::flash('flash_message','User id '.$id.' is Enabled');
		   	//dd($users);
		return view('admins.edituser',compact('users'));
	   }

	   public function showuser($id){
	   			//dd ($id);
	   		$users = ManageUser::where('is_admin','=',0) 
	   							->get();
	   		ManageUser::where('id',$id)
	   						->update(array('status'=>1));
	   	
	   	return back();
	   }

	   public function update(Request $request){

	   	//dd($request);
	   	$validatedData = $request->validate([
                'name' => 'required||max:255',
                'status' => 'required|numeric',
            ]);


	   	ManageUser::where('id',$request->id)
	   							//->update(array($request->except('_token','id')));
	   							->update(array('name'=>$request->name,'status'=>$request->status));
	   		//update user status 

	   		Session::flash('flash_message', 'User status has changed');
			//Using laravel flash to asign flash_message to some 
			//value then display it in a blade
		return redirect('/manageuser');


	   }



}
