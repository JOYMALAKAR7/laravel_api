<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Function to create User
    function createUser(Request $request)
    {
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
