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
        $this->usersModel = new Users();
        $this->Mailer = new MailController();
    }

    public static function validateUserPin($pin, $walletId)
    {
        $requestPin = $data['pin'];

        $usersModel = new Users();
        $userData = $usersModel->getUserByWalletID($walletId);

        if (Hash::check($pin, $userData['pin'])) {
            return true;
        } else {
            return false;
        }
    }

    public function registerUser(Request $request)
    {
        $params = parseRequest($request, true);

        // Perform Unique User Checks
        if (
            $this->usersModel->getUserByPhoneNumber($params['phonenumber']) !=
            false
        ) {
            $msg = 'User already exist';
            return standardResponse(false, $msg);
        }

        if ($params['password'] !== $params['retypepassword']) {
            $message = 'Passwords do not match!';
            return standardResponse(false, $message, 400);
        }

        $userdata = [
            'fullname' => ucwords(strtolower($params['fullname'])),
            'phonenumber' => $params['phonenumber'],
            'password' => hash::make($params['password']),
            'pin' => hash::make($params['pin']),
            'walletID' => WalletController::generateWalletId(
                $params['phonenumber']
            ),
            'status' => 'active',
        ];

        $saveUser = $this->usersModel->saveUserDetails($userdata);

        if ($saveUser) {
            $msg = 'Signup Successful.';
            return standardResponse(true, $msg);
        } else {
            $msg = 'Signup Failed. Please retry later';
            return standardResponse(false, $msg);
        }
    }

    public function loginUser(Request $request)
    {
        $params = parseRequest($request);

        //check if password matches

        $verifyPassword = $this->verifyPassword($request);

        if (!$verifyPassword) {
            //User's email or password is incorrect
            $msg = 'Wrong Login Parameters!';
            return \standardResponse(false, $msg);
        }

        $verifyPassword = $verifyPassword->toArray();

        //return the user details back except from password, created and updated_at and remember_token
        unset($verifyPassword['password']);
        unset($verifyPassword['created_at']);
        unset($verifyPassword['updated_at']);

        $userDetails = $verifyPassword;
        if ($userDetails) {
            $userDetails['token'] = $this->JwtIssuer($userDetails);
            // set user details in session
            $msg = 'Login Successful';
            return standardResponse(true, $msg, $userDetails);
        } else {
            $msg = 'Login Failute';
            return standardResponse(false, $msg);
        }
    }

    public function verifyPassword(Request $request)
    {
        $loginParam = $request->input('loginparam');
        // Check if Login Param is Email
        $type = '';
        $check = $this->checkEmail($loginParam);
        if ($check) {
            $type = 'email';
        }
        //check if user exists
        try {
            if ($type == 'email') {
                \Log::info('Login Param is Email ...');
                $userDetails = Users::where(
                    'email',
                    '=',
                    $request->input('loginparam')
                )->first();
            } else {
                \Log::info('Login Param is Phone Number ...');
                $userDetails = Users::where(
                    'phonenumber',
                    '=',
                    $request->input('loginparam')
                )->first();
            }
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            $msg = 'Login Failure !';
            return \standardResponse(false, $msg);
        }

        if ($userDetails) {
            //check if password matches
            if (
                Hash::check($request->input('password'), $userDetails->password)
            ) {
                return $userDetails;
            }
        }

        return false;
    }

    public function checkEmail($email)
    {
        $find1 = strpos($email, '@');
        $find2 = strpos($email, '.');
        return $find1 !== false && $find2 !== false && $find2 > $find1
            ? true
            : false;
    }
}
