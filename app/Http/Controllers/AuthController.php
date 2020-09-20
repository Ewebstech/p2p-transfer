<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Mail\resetPassword;
use App\ResetPasswordToken;
use Illuminate\Http\Request;
use App\Helpers\HttpStatusCodes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\WalletController;

class AuthController extends Controller
{
    protected $helper;

    public function __construct()
    
    {
        if(!isset($_SESSION)) {
            session_set_cookie_params(strtotime('30+ minutes', 0));
            session_start();
        }

        $this->usersModel = new Users;
        $this->Mailer = new MailController;
    }

    public static function validateUserPin($data){
        $requestPin = $data['pin'];

        $usersModel = new Users;
        $userData = $usersModel->getUserByWalletID($data['sessiondata']['walletID']);
        
        if(isset($userData['pin'])){
            $usersPin = $userData['pin'];
        } else {
            $usersPin = substr($data['sessiondata']['phonenumber'], -4);
        }

        if($requestPin == $usersPin){
            return true;
        } else {
            return false;
        }
    } 

    public function viewMailTemplate()
    {
        $data = [];
        return view('emails.airtime', $data);
      
    }

    public function registerUser(Request $request){
        $params = parseRequest($request, true);

        // Perform Unique User Email Checks
        if($this->usersModel->getUser($params['email']) !== false){
            $status = "failure";
            $data = "Email Address Already Exists!";
            return $this->returnOutput($status,$data);
        }

        // Perform Unique User Phonenumber Checks
        if($this->usersModel->getUserByPhoneNumber($params['phonenumber']) !== false){
            $status = "failure";
            $data = "Phone Number Already Exists!";
            return $this->returnOutput($status,$data);
        }

         // Perform Unique User Phonenumber Checks
         if($params['password'] !== $params['retypepassword']){
            $status = "failure";
            $data = "Passwords do not match!";
            return $this->returnOutput($status,$data);
        }

        $userdata = [
            'fullname' => ucwords(strtolower($params['fullname'])),
            'phonenumber' => $params['phonenumber'],
            'email' => strtolower($params['email']),
            'password' => hash::make($params['password']),
            'walletID' => WalletController::generateWalletId($params['phonenumber']),
            'status' => 'inactive'
        ];

        $saveUser = $this->usersModel->saveUserDetails($userdata);

        if($saveUser){
           
            $status = "success";
            $data = "Signup Successful. Please check your Mailbox";
            $this->returnOutput($status,$data);

            // Send Email to User
            $mailParams = [
                'Name' => $userdata['fullname'],
                'Email' => $userdata['email'],
                'Subject' => 'Account Confirmation - '. $userdata['fullname'],
                'template' => 'register',
                'Link' => "https://www.blossompay.com.ng/account-activation/".$userdata['email']
            ];

            $sendMail = $this->Mailer->sendMail($mailParams);
            \Log::info("Email Notification Response: " . $sendMail);

        } else {
            $status = "failure";
            $data = "Signup Failed. Please try again later";
            return $this->returnOutput($status,$data);

        }
        
    }

    public function activateAccount($param){
        \Log::info("Recieved Parameter for Account Activation: " . $param);
        $userData = $this->usersModel->getUser($param);
        if($userData !== false && $userData['status'] == "inactive"){
            $params = $userData;
            $params['data'] = [
                'status' => 'active'
            ];

            $updateUser = $this->usersModel->updateUser($params);

            if($updateUser){
                return redirect('login')->with('status', 'Account Activated. Please Log In');
            }
            
        } else {
            return redirect('404');
        }
    }


    public function loginPage(Request $request){
       
        if(!isset($_SESSION['UserDetails'])){
            return view('login');
        } else { 
            if(isset($_SESSION['PreviousUrl'])){
                $url = $_SESSION['PreviousUrl'];
                unset($_SESSION['PreviousUrl']);
                return redirect()->route($url);
            } else{
                return redirect()->route('Dashboard');
            }   
        }
    }

    public function loginUser(Request $request) {
        $params = parseRequest($request);
        
        //check if password matches
       
        $verifyPassword = $this->verifyPassword($request);
        
        if(!$verifyPassword) {
            //User's email or password is incorrect
            $status = "failure";
            $data = "Wrong Username/Password!";
            return $this->returnOutput($status,$data);
            
        }  
        \Log::info($verifyPassword);
        $verifyPassword = $verifyPassword->toArray();
        
        //return the user details back except from password, created and updated_at and remember_token
        unset($verifyPassword['password']);
        unset($verifyPassword['created_at']);
        unset($verifyPassword['updated_at']);
        unset($verifyPassword['remember_token']);

        $userDetails  = $verifyPassword;

        if($userDetails['status'] == "inactive"){
            $status = "failure";
            $data = "Account Not Confirmed. Please check your email!";
            return $this->returnOutput($status,$data);
        }
        
        if($userDetails){
            // set user details in session
            //dd($userDetails);
            $allDetails = $userDetails;
            $sessionUserDetails = $this->setSession($allDetails);

            $status = "success";
            $data = "Login Successful";
            return $this->returnOutput($status,$data);
        } else {
            $status = "failure";
            $data = "Login Failure !";
            return $this->returnOutput($status,$data);
        }
    
    }

    public function verifyPassword(Request $request) {
        $loginParam = $request->input('loginparam');
        // Check if Login Param is Email
        $type = "";
        $check = $this->checkEmail($loginParam);
        if($check){
            $type = "email";
        } 
        //check if user exists
        try{
            if($type == "email"){
                \Log::info("Login Param is Email ...");
                $userDetails = Users::where('email', '=', $request->input('loginparam'))->first();
            } else {
                \Log::info("Login Param is Phone Number ...");
                $userDetails = Users::where('phonenumber', '=', $request->input('loginparam'))->first();
            }
            
        }catch(\Exception $e) {
            //something wemt wrong 
            \Log::info($e->getMessage());
            $status = "failure";
            $data = "Login Failure !";
            return $this->returnOutput($status,$data);
        }
        
        if($userDetails) {
            //check if password matches
            if(Hash::check($request->input('password'), $userDetails->password)) {
                return $userDetails;
            }
        }
        
        return false;
    }

    public function setSession($userDetails){
        if(isset($_SESSION['UserDetails'])){
            unset($_SESSION['UserDetails']);
        }
        foreach ($userDetails as $field => $value) {
            # code...
            $_SESSION['UserDetails'][$field] = $value;
        }
        return $_SESSION['UserDetails'];
    }

    public function checkEmail($email) {
        $find1 = strpos($email, '@');
        $find2 = strpos($email, '.');
        return ($find1 !== false && $find2 !== false && $find2 > $find1 ? true : false);
    }

    public function logout(){
        unset($_SESSION['UserDetails']);
        session_destroy();
        return Redirect::to('/login');
        
    }

    


}
