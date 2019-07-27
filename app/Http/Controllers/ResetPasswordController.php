<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Mail;
use App\User;
use App\Mail\ResetPasswordMail;
use DB;
use App\Http\Requests\changePasswordRequest;
use Illuminate\Support\Str;



class ResetPasswordController extends Controller
{
    
    public function sendEmail(Request $request){
        if(!$this->validateEmail($request->email)){
            return $this->failedResponse();
        }
        $this->send($request->email);
        return $this->successResponse();
    }

   

    public function send($email){
        $token=$this->createToken($email);
        Mail::to($email)->send(new ResetPasswordMail($token));
    }

    public function createToken($email){
       
        if($oldToken = DB::table('password_resets')->where('email',$email)->value('token')){
            return $oldToken;
        }

        $token = str_random(60);
        $this->saveToken($token,$email);
        return $token;
    }

    public function saveToken($token,$email){
        DB::table('password_resets')->insert([
            'email'=>$email,
            'token'=>$token,
        ]);
    }


    public function validateEmail($email){
        return !!User::where('email',$email)->first();

    }

    public function failedResponse(){
        return response()->json([
            'error' => 'Email doesn\'t found'
        ],Response::HTTP_NOT_FOUND);

    }

    public function successResponse(){
        return response()->json([
            'data' => 'Reset Email is send successfully, please check your inbox'
        ],Response::HTTP_OK);

    }

    public function process(changePasswordRequest $request){

        
        if($this->getPasswordResetTableRow($request)->count()>0){
            return $this->changePassword($request);
        }
        return $this->tokenNotFoundResponse();
        

    }

    private function getPasswordResetTableRow($request){
        return DB::table('password_resets')->where(['email'=>$request->email,
        'token'=>$request->resetToken]);
    }

    private function tokenNotFoundResponse(){
        return response()->json([
            'error' => 'Given token or email does not found'
        ],Response::HTTP_NOT_FOUND);
    }

    private function changePassword($request){
        $user =User::whereEmail($request->email)->first();
        $user->update(['password'=>bcrypt($request->input('password'))]);
        $this->getPasswordResetTableRow($request)->delete();
        return response()->json(['data'=>'Password Succesfully Changed',200]);

        
    }
    
    
    
}
