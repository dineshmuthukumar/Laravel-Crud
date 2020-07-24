<?php

namespace App\Http\Controllers;


use App\User;

use Illuminate\Http\Request;
use Validator;
// use Illuminate\Http\Request;

class Userscontroller extends Controller
{
    public function home()
    {
    	
    	$User = User::latest()->paginate(5);
  
        return view('index',compact('User'))
            ->with('i', (request()->input('page', 1) - 1) * 5);


    	//return view('welcome');
    }

    public function create()
    {
        return view('create');
    }
    
    public function add(request $request)
    {

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

         $User->profile_picture = $input['imagename'];
         $User->phone = $request->phone;
         $User->password = base64_encode($request->password);
         $User->save();
         chmod(public_path('/uploads/'.$input['imagename']), 0777);
         return redirect('/')->with('success','User Created successful');
    	// echo "<pre>";
    	// print_r($request->all());
    	// die();
    	# code...
    }

    public function edit($id)
    {
        $data = User::where('id',$id) -> first();
        // echo '<pre>';
        // print_r($data);

        return view('edit', compact('data'));
        //die();
        # code...
    }

    public function update(request $request)
    {

        $request->validate([
            'name' => 'required',
            'profile_picture'=>'image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'phone' => 'required',
            'password' => 'required|min:6s',
            'confirm_password' => 'required|min:6',
        ]);

        //$selection = Selection::find($id);
       // $User = User::where ("id",$request->id);

        $User = User::where('id', $request->id)->first();

        $User->name = $request->name;
        $User->email = $request->email;
         //$User->type = $request->type;
         //$User->email = $request->email;

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
        $User->phone = $request->phone;
        $User->password = base64_encode($request->password);
        $User->save();
        if(!empty($request->file('profile_picture'))) {
            chmod(public_path('/uploads/'.$input['imagename']), 0777);
        }
        return redirect('/')->with('success','User update successful');
      /*  echo "<pre>";
        print_r($request->all());
        die();*/
    }
     public function view($id)
    {
        $data = User::where('id',$id) -> first();
        // echo '<pre>';
        // print_r($data);

        return view('view', compact('data'));
        //die();
        # code...
    }
      public function delete($id)
    {
        $data = User::where('id',$id) -> delete();
        // echo '<pre>';
        // print_r($data);

         return redirect('/')->with('success','User Delete successful');
        //die();
        # code...
    }


}
