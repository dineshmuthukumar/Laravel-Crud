<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class apicontroller extends Controller
{

	public function list()
    {
    	
    	$User = User::all();


    	return response()->json([
    		'code'=>200,
		    'success' => true,
		    'message'=>"Records fetch successfully",
		    'data' => $User
		], 200);

    	//return response()->json(['data' => $User], 201); 
  			
  		//return->json($User);
  		/*print_r($User);
  		die();*/
        //return view('index',compact('User'))
       //     ->with('i', (request()->input('page', 1) - 1) * 5);


    	//return view('welcome');
    }

    public function edit($id)
    {
        $data = User::where('id',$id) -> first();
        // echo '<pre>';
        // print_r($data);

        return response()->json(['data' => $data], 201); 
        //die();
        # code...
    }


    public function update(request $request)
    {


    	    	try {
      
		      	  $request->validate([
		            'name' => 'required',
		            'profile_picture'=>'image|mimes:jpeg,png,jpg|max:2048',
		            'email' => 'required|email|unique:users,email,'.$request->id,
		            'phone' => 'required'
		        ]);

		        //$selection = Selection::find($id);
		       // $User = User::where ("id",$request->id);

		        $User = User::where('id', $request->id)->first();

		        $User->name = $request->name;
		        $User->email = $request->email;
		         //$User->type = $request->type;
		         //$User->email = $request->email;

		        
		        $User->phone = $request->phone;
		        $User->password = base64_encode($request->password);
		        $User->save();


		         return response()->json([
		        	'response'=>true,
		            'status' => 'success',
		            'msg'    => 'Okay'
		        ], 201);
		       

		    }
		    catch (ValidationException $exception) {

		        return response()->json([
		        	'response'=>false,
		            'msg'    => 'Error',
		            'errors' => $exception->errors()
		        ], 422);


		    }


      
        //return redirect('/')->with('success','User update successful');

      }

     public function add(request $request)
    {


    	try {
      
      	$request->validate([
		            'name' => 'required',
		            'profile_picture'=>'required|image|mimes:jpeg,png,jpg|max:2048',
		            'email' => 'required|email|unique:users',
		            'phone' => 'required',
		            'password' => 'required|min:6s',
		            'confirm_password' => 'required|min:6',
		        ]);

		         $User = new User() ;
		        // $User->password = bcrypt($request->password);
		         $User->name = $request->name;
		         $User->email = $request->email;
		         //$User->type = $request->type;
		         //$User->email = $request->email;

		         $image = $request->file('profile_picture');

		         $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

		         $destinationPath = public_path('/uploads');

		         $image->move($destinationPath, $input['imagename']);

		         chmod(public_path('/uploads/'.$input['imagename']), 0777);

		         $User->profile_picture = $input['imagename'];
		         $User->phone = $request->phone;
		         $User->password = base64_encode($request->password);
		         $User->save();

		        return response()->json([
		        	'response'=>true,
		            'status' => 'success',
		            'msg'    => 'Okay'
		        ], 201);

		    }
		    catch (ValidationException $exception) {

		        return response()->json([
		        	'response'=>false,
		            'msg'    => 'Error',
		            'errors' => $exception->errors()
		        ], 422);


		    }
    }

    //
}
