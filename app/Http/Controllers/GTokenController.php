<?php

namespace App\Http\Controllers;
use vendor\autoload;
use Illuminate\Http\Request;
use App\User;
use JWTAuth;

class GTokenController extends Controller
{
    public function loginUser($user){
        //echo $user;
        //$token = $payload['id_token'];
    
       // return response()->json(['token' => 'asfh'], 401);
        
      //  $user=User::where('email','=',$payload['email'])->first();
    
            if (!$userToken=JWTAuth::fromUser($user)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
            //return response()->json(['token' => $userToken], 401);
           // return 'hello';
        
           if(!$user->emailStatus){
            $user->emailStatus = '1';
            $user->save();
           // return response()->json(['message' => 'Account activated !'], 200);
            return response()->json(['message' => 'Account activated !','token'=>$userToken,'user'=>$user,'role'=>$user->role]);
        }
      
    
        if($user->isDeleted){
            $this->restoreUser($user->ID);
           // return response()->json(['message' => 'Account activated !'], 200);
            return response()->json(['message' => 'Account activated !','token'=>$userToken,'user'=>$user,'role'=>$user->role]);
        }
        
        //echo $userToken;
        //$token = JWTAuth::fromUser($user);
        //return response()->json(['snack'=>"Didn't you receive the verification email?",'message' => "You would have received a verification email with link. Please click it !"]);
        return response()->json(['token'=>$userToken,'user'=>$user,'role'=>$user->role]);
        
        
    }

    public function restoreUser($ID){

        user::where(['ID'=>$ID])->update(['isDeleted'=>'0']);
    }
    

   

public function verify(Request $request){
   $id_token=$request->input('token');;
    $CLIENT_ID='604126479887-9vpo97k8caubk13hc87m0e5vhngjlrje.apps.googleusercontent.com';
    
    $client = new \Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
    
    $payload = $client->verifyIdToken($id_token);
    if ($payload) {
        //return $payload;
        return $this->loginOrRegister($payload);
      // If request specified a G Suite domain:
      //$domain = $payload['hd'];
    } else {
      // Invalid ID token
      return "Invalid ID token";
    }
 
  }

  public function loginOrRegister($payload){

    if(!!$user=$this->isRegistered($payload['email'])){
        //return $payload;
         return $this->loginUser($user);
          
     }else{
         
         $this->registerUser($payload);
         if(!!$user=$this->isRegistered($payload['email'])){
           return $this->loginOrRegister($payload);
         }
     }
  }


  public function isRegistered($email){
    
    return User::whereEmail($email)->first();

  }

  public function registerUser($payload){

    
/*
$user=User::create($request->all());

return ["message"=>"User Created","user"=>$user];
*/



    $table = new User;
    $table->firstName =$payload['given_name'];
    $table->lastName = $payload['family_name'];
    $table->email = $payload['email'];
    $table->profileImage = $payload['picture'];
    $table->emailStatus = '1';

$table->save();

return $thisUser=User::findOrFail($table->ID);
    
}


}
