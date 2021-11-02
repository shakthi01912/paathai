<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Mail;


class UserController extends Controller
{
    function login(Request $request){

        {
            $userModel= User::where('email', $request->email)->first();
             
                if (!$userModel || !Hash::check($request->password, $userModel->password)) {
                    return response([
                        'message' => ['These credentials do not match our records.']
                    ], 404);
                }
            
                 $token = $userModel->createToken('my-app-token')->plainTextToken;
            
                $response = [
                    'user' => $userModel,
                    'token' => $token
                ];
            
              
                return response($response, 201);
        }
}
function changePassword(Request $request){
   
    $userRow= User::where('id', $request->id)->first();
      
     if (!$userRow || !Hash::check($request->oldPassword, $userRow->password)) {
         return response([
             'message' => ['Id or password is wrong']
         ], 404);
     }
     
     $userRow->id = $request->id;
     $userRow->password = Hash::make($request->newPassword);

     $result  = $userRow ->save();

     return "password has been changed";
 

 
}

function forgetPasswordOTP(Request $request){
 
    $email=$request->email;
    $user= User::where('email', $request->email)->first();

   
    if( is_null($user))
       {
        return ["Result"=>"Your email id  is not found"];
       }
       
        $otp = $this->generateRandomString();

        $user->otp = $otp;
        $result = $user->save();


        if(!$result){
            return "data has not been saved in database";
        
        }
  
        $emailData = [
              
              'email' => $user->email,
              'OTP'=> $otp,
              'subject' => "OTP has been sent!",
              'fromEmail' => "abc@gmail.com",
              'fromName' => "POS System"
          ];  
  
          $data = array('email'=> $user->email,'OTP'=> $otp);
          Mail::send('OtpValidate', $data, function($message) use ($emailData){
             $message->to( $emailData['email'], $emailData['OTP'])
             ->subject($emailData['subject']);
             $message->from( $emailData['fromEmail'],$emailData['fromName']);
          });
        

        //   if($mailOutput){ 
        //     return "Error in sending OTP...";
        //   }
            return "OTP send successfully....";  
    }



function forgetPasswordOTPValidation(Request $request){
    $user= User::where('email', $request->email)->first();
         
            if (!$user || $request->otp != $user->otp) {
                return response([
                    'message' => ['Your otp or mail do not match our records.']
                ], 404);
        
            }

    
            $user->password = $request->newPassword;

            $result  = $user ->save();
          return " Changed successfully!!!";
      

        }

       function generateRandomString($length = 8) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        

}

 
}