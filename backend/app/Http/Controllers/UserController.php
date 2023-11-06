<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
public function index(){

    try {
        $users = User::all();

        if ($users->count() > 0){
            return response()->json([$users], 200);
                }else{
            return response()->json([
            "status"=>400,
            "message"=>"No record found"
            ], 400);
                }
                
    } catch (\Throwable $th) {
        throw $th;
    }
 

    
}//end of index


public function store(Request $request){
$validator = Validator::make($request->all(), [
   "name"=>"required|string|max:191", 
   "email"=>"required|string|max:191", 
   "password"=>"required|string|max:191", 
]);

if ($validator->fails()){
    return response()->json([
        "status"=>400,
        "errors"=>$validator->messages()
            ],400);
}else{
    $users = User::create([
        "name"=>$request->name,
        "email"=>$request->email,
        "password"=>$request->password
    ]);

    if ($users){
        return response()->json(["message"=>"User Created","payload"=>$users],201);
    }else{
        return response()->json([
        "status"=>500,
        "errors"=>"Something went wrong"
        ],500);
    }
}
}//end of store


public function show($id){
    $user = User::find($id);

    if ($user){
        return response()->json([
            "status"=>200,
            "user"=>$user
        ], 200);
    }else{
        return response()->json([
"status"=>400,
"message"=>"No user found!"
        ],400);
    }
}//end of show

public function update(Request $request, int $id){

    try {
        $user = User::find($id);
        
        if(!$user){
            return response()->json(['message' => 'Record not found'], 404);
        }else{

            $request->validate([
                "name" => "required",
                "email" => "required",
                "password" => "required",
            ]);

            $user->update([
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "password" => $request->input('password'),
            ]);

            return response()->json(["message"=>"User Updated","payload"=>$user],200);
            
        }

    } catch (\Throwable $th) {
        throw $th;
    }
    
  }//end of update function

  public function destroy($id){

    try {
        $user = User::find($id);

        if($user){
            
            $user->delete();

            $updated_users = User::all();
            return response()->json(["message"=>"User Deleted","payload"=>$updated_users],200);
        }else{
            return response()->json([
                "status" => 404,
                "messages" => "User not found!"
            ],404);
        }

    } catch (\Throwable $error) {
        throw $error;
    }
   
    
   }//end of delete function

}