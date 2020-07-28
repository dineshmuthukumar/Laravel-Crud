<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Input;
/*use Illuminate\Http\JsonResponse;
*/
use Illuminate\Support\Facades\Validator;

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
    }


    public function add(request $request)
    {



    	try {
      	
      

      	   $request->validate([
            'name' => 'required',
            'profile_picture'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|min:6'
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
		         $User->password = md5($request->password);
		         $User->save();

		        return response()->json([
		        	'response'=>true,
		        	'code'=>200,
		            'status' => 'success',
		            'msg'    => 'User Added successfully'
		        ], 200);

		    }
		    catch (\Exception $exception) {


		        return response()->json([
		        	'response'=>false,
		        	'code'=>'422',
		            'msg'    =>  $exception->getMessage(),
		            'errors' => $exception->errors(),
		        ], 422);


		    }
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


		        if(!empty($request->file('profile_picture'))) {

		          $image_path = public_path('/uploads/').$User->profile_picture;

		           if (file_exists($image_path)) {
		              //File::delete($image_path);
		              unlink($image_path);
		          }

		                $image = $request->file('profile_picture');

		                $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

		                $destinationPath = public_path('/uploads');

		                $image->move($destinationPath, $input['imagename']);

		                $User->profile_picture = $input['imagename'];

		        }
		         //$User->type = $request->type;
		         //$User->email = $request->email;

		        
		        $User->phone = $request->phone;
		        $User->password = base64_encode($request->password);

		        if(!empty($request->file('profile_picture'))) {
           				 chmod(public_path('/uploads/'.$input['imagename']), 0777);
                }
		        $User->save();


		         return response()->json([
		        	'response'=>true,
		        	'code'=>200,
		            'status' => 'success',
		            'msg'    => 'User update successfully'
		        ], 200);
		       

		    }
		    catch (\Exception $exception) {

		        return response()->json([
		        	'response'=>false,
		            'code'=>422,
		            'msg'    =>  $exception->getMessage(),
		            'errors' => $exception->errors(),
		        ], 422);


		    }


      
        //return redirect('/')->with('success','User update successful');

      }

       public function view($id)
	    {	

	    	 try {
	          $data = User::where('id',$id) -> first();
		        // echo '<pre>';
		        // print_r($data);

	           return response()->json([
			        	'response'=>true,
			        	'code'=>200,
			            'data' => $data,
			            'msg'    => 'User fetched successfully'
			        ], 200);

		      }
		      catch (\ModelNotFoundException $exception) {

			        return response()->json([
			        	'response'=>false,
			            'code'=>422,
			            'msg'    =>  $exception->getMessage(),
			            'errors' => $exception->errors(),
			        ], 422);
	       	}
	        
	    }

	    public function delete(request $request)
    {

    	// $data = request()->json()->all();  // This returns empty array

    	// dd($data);
    	// die();
    	 try {

        $data = User::where('id',$request->id) -> delete();
        // echo '<pre>';
        // print_r($data);
         return response()->json([
			        	'response'=>true,
			        	'code'=>200,
			            'msg'    => 'User Delete successfully'
			        ], 200);

         } catch (\Exception $exception) {

			        return response()->json([
			        	'response'=>false,
			            'code'=>422,
			            'msg'    =>  $exception->getMessage(),
			            'errors' => $exception->errors(),
			        ], 422);
	    }
        //die();
        # code...
	  }


	   public  function updatenew(request $request){

	      $get_result_arr = $request->json()->all();

    	    try {
      

		       
		        $User = User::where('email', $get_result_arr['email'])->first();

		        if(empty($User)){

		        	     $User = new User();
		        // $User->password = bcrypt
		        	    $User->name = $get_result_arr['name'];
				        $User->email = $get_result_arr['email'];


				      
				         //$User->type = $request->type;
				         //$User->email = $request->email;

				        $User->profile_picture = '';

				        
				        $User->phone = $get_result_arr['phone'];
				        $User->password = md5($get_result_arr['password']);

				
				        $User->save();


				         return response()->json([
				        	'response'=>true,
				        	'code'=>200,
				            'status' => 'success',
				            'msg'    => 'User update successfully'
				        ], 200);
				       

		        } else {

		        	  return response()->json([
				        	'response'=>false,
				        	'code'=>200,
				            'status' => 'fail',
				            'msg'    => 'email alrready exist'
				        ], 200);
		        }

		      

		    }
		    catch (\Exception $exception) {

		        return response()->json([
		        	'response'=>false,
		            'code'=>422,
		            'msg'    =>  $exception->getMessage(),
		            'errors' => $exception->errors(),
		        ], 422);


		    }

	  }
    
}
