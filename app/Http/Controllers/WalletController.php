<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\resetPassword;
use App\ResetPasswordToken;
use Illuminate\Http\Request;
use App\Helpers\HttpStatusCodes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class WalletController extends Controller
{

    public static function generateWalletId($walletString){
        \Log::info("Generating Wallet ID .... ");
        $WalletID = substr($walletString, -10);
        \Log::info("Wallet ID Generated: " . $WalletID);
        return $WalletID;
    }

    public static function getWalletBalance($userDetails){

        return 0;

    } 

}