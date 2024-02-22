<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //Function to create User
    function createUser(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>"required|string",
            'email'=>"required|string",
            'phone'=>"required|numeric",
            'password'=>"required|min:6"
          
        ]);
        if($validator->fails()){
            $resul = array('status' => false, 'message' => "something went wrong",
            'error_message'=>$validator->error());
            return response()->json($resul,400);
        }

      
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password)
        ]);

        if ($user) {
            $resul = array('status' => true, 'message' => "user create successfull",'data'=>$user);
            $responseCode=200;
        } else {
            $resul = array('status' => false, 'message' => "something went wrong");
            $responseCode=400;
        }

        return response()->json($resul,$responseCode);
    }
}
