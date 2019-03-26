<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\verifyEmail;
use phpDocumentor\Reflection\Types\Null_;
use JWTAuth;
use App\Http\Controllers\Controller;


class userController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth:api', ['only' => ['logoutUser']]);
    }



	public function registerUser(Request $request){

			$request->validate([
				'firstname' => 'required|max:20',
				'lastname' => 'required|max:20',
				'email' => 'required|email|unique:users',
				'password' => 'required|min:6',
                'confirm_password' => 'required|min:6|same:password'
            // new rules here
        ]);
/*
    $user=User::create($request->all());

    return ["message"=>"User Created","user"=>$user];
*/



			$table = new User;
			$table->firstName = $request->input('firstname');
			$table->lastName = $request->input('lastname');
			$table->email = $request->input('email');
			$table->password = bcrypt($request->input('password'));
            $table->verifyToken=Str::random(40);

        $table->save();


        $thisUser=User::findOrFail($table->id);
        $this->sendEmail($thisUser);

			
			return response()->json(['alert'=>"You would have received a verification email with link. Please click it!"]);
	}

    public function sendEmail($thisUser){


        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));


    }

    public function sendEmailDone($email,$verifyToken){
	    $user = User::where(['email'=>$email,'verifyToken'=>$verifyToken])->first();
	    if($user){
	        user::where(['email'=>$email,'verifyToken'=>$verifyToken])->update(['emailStatus'=>'1','verifyToken'=>Null]);
            return redirect('http://localhost:8080/loginPage')->with('responseReg','Registration & verification Completed');
            
        }else{
            return redirect('http://localhost:8080/loginPage')->with('responseVerifyErr','User Not Found');
        }

    }




    public function loginUser(Request $request){

        $data = $request->only('email','password');

        if(!$token=JWTAuth::attempt($data)){
        //    if ($token = $this->guard()->attempt($data)) {
                return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $user =auth()->user();
        

        if(!$user->emailStatus){
            return response()->json(['alert' => 'Email not verified'], 200);
        }
        

        //$token = JWTAuth::fromUser($user);
        return response()->json(['token'=>$token,'user'=>$user]);
        
        
	}


public function getLogged(){
		return view('logged');
	}

public function verifyEmailFirst(){

    return view('email/verifyEmailFirst');
}

//Check this neccesary or not
    public function loginPage(){
        if(Auth::user()){
            return redirect('/logged');
        }
        return view('loginPage');
        
    }



	public function registerPage(){
        if(Auth::user()){
            return redirect('/logged');
        }
		return view('registerPage');
	}

public function logoutUser(Request $request){
		/*Auth::logout();
		Session::flush();
        return redirect('/loginPage')->with('responseLogout','Logout Succesfully');*/
      //  auth()->logout();


      /*
        $user = User::first();
        $token = JWTAuth::fromUser($user);
        auth()->logout();
       return response()->json(['msg'=>'Succesfully logged out','token'=>$token]);
*/



       /*
        $token=JWTAuth::getToken();
        try{
            $token=JWTAuth::invalidate($token);
            return response()->json(['token' => $token]);
        }catch(Exception $e){

        }*/

        //$this->validate($request, ['token' => 'required']);
        
        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true, 'message'=> "You have successfully logged out."]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    }
    



    public function refresh()
    {
        $token=JWTAuth::getToken();
        try{
            $token=JWTAuth::refresh($token);
            return response()->json(['token' => $token]);
        }catch(Exception $e){
            Response::json(['msg' => "Need to login again"]);

        }
    }
    

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }

    public function me()
    {
        /*
        $token=JWTAuth::getToken();
        $user = User::first();
       // $token = JWTAuth::fromUser($user);
        
        return response()->json(['token'=>$token,'user'=>$user]);
      //  return response()->json(['user'=>auth()->user()]);*/


      try {
                
                if (! $user = JWTAuth::parseToken()->authenticate()) {
                        return response()->json(['user_not_found'], 404);
                }


        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                return response()->json(['token_absent'], $e->getStatusCode());

        }

            return response()->json(compact('user'));
        
    }



}
