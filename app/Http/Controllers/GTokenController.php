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
   // $id_token='eyJhbGciOiJSUzI1NiIsImtpZCI6ImRmMzc1ODkwOGI3OTIyOTNhZDk3N2EwYjk5MWQ5OGE3N2Y0ZWVlY2QiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwiYXpwIjoiNjA0MTI2NDc5ODg3LTl2cG85N2s4Y2F1YmsxM2hjODdtMGU1dmhuZ2pscmplLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiYXVkIjoiNjA0MTI2NDc5ODg3LTl2cG85N2s4Y2F1YmsxM2hjODdtMGU1dmhuZ2pscmplLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwic3ViIjoiMTEzNTAzMTk3ODU4Mjg1OTUwNjAxIiwiZW1haWwiOiJqZXdlbHBhY2tzcGFydGFAZ21haWwuY29tIiwiZW1haWxfdmVyaWZpZWQiOnRydWUsImF0X2hhc2giOiJyWXJqTzFhcVFBYUwxenR3anlWMDl3IiwibmFtZSI6Ikpld2VsIFBhY2siLCJwaWN0dXJlIjoiaHR0cHM6Ly9saDQuZ29vZ2xldXNlcmNvbnRlbnQuY29tLy1yaEhvbTQtZHRwOC9BQUFBQUFBQUFBSS9BQUFBQUFBQUFBQS9BQ0hpM3JlM1BIaUtGSk1FSWpKMXAzU2JoYkQtc1Nua0xBL3M5Ni1jL3Bob3RvLmpwZyIsImdpdmVuX25hbWUiOiJKZXdlbCIsImZhbWlseV9uYW1lIjoiUGFjayIsImxvY2FsZSI6ImVuIiwiaWF0IjoxNTY0NTczNTA5LCJleHAiOjE1NjQ1NzcxMDksImp0aSI6IjYwNTNjMjk5MjU0YTg3YzU5ZjQ2ZDZlYWVhYjMyY2ZmNWQ5ZWYyNzQifQ.jbsJluRYQE4PO3fzk5qr_ACdCnRb48vm8u7RCF6idO99e_FHtbVxJHeR43hLNhNL6p4556swQxDdiNseCMm6qbZY2olF-sHVBxR7zOZCU1EY_bFzJ7FO4XExfXFLr39QBnskXh4j8tDOKefRHRU-CvG8KjQBDi4xf1FKEONRhX7eUXBCr7p0QS9inzOMOCkwqBlcRIQhhP4xL3e_ro5C08feGZkk9M4EJTl5_8hsar4l43Zj1s0jAD_H9KKcJWd4XIOx9qGI4Lh8ktyBptnxGBZRDvsRrBaFvdTZKNlAULNiZJ9i2NlWuruYw6nplqdDvYW1QzRU3VstGq5xVg7-MQ';
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
