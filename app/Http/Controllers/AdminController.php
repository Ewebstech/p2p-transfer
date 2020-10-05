<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Wallets;
use App\Mail\resetPassword;
use App\ResetPasswordToken;
use App\Models\Transactions;
use Illuminate\Http\Request;
use App\Helpers\HttpStatusCodes;
use App\Http\Controllers\Generator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PaystackController;
use App\Http\Controllers\TransactionsController;

class AdminController extends Controller
{

    public function isAdminUser($UserDetails){
        $adminSettings = env('admins', '8133918455,7016484057');
        $admins = explode(",", $adminSettings);

        if(in_array($UserDetails['walletID'],$admins)){
            return true;
        } else {
            return false;
        }
    }

    public function getManualWalletFundPage(Request $request){

        $requestParams = parseRequest($request, true);

        $UserDetails = $_SESSION['UserDetails'];
        $data['sessiondata'] = $UserDetails;

        $URI= $this->isAdminUser($UserDetails) ? '/admin/manual-fund' : '/dashboard';
    
        return view($URI)->with($data);
    }

    public function getWalletsPage(Request $request){

        $requestParams = parseRequest($request, true);

        $UserDetails = $_SESSION['UserDetails'];
        $data['sessiondata'] = $UserDetails;

        $params['walletID'] = $UserDetails['walletID'];

        $WalletModel = new Wallets;
        
        $data['transactions'] = $WalletModel->fetchAllWallets();

        $URI= $this->isAdminUser($UserDetails) ? '/admin/wallets' : '/dashboard';
    
        return view($URI)->with($data);


    }

    public function getFundHistoryPage(Request $request){

        $requestParams = parseRequest($request, true);

        $UserDetails = $_SESSION['UserDetails'];
        $data['sessiondata'] = $UserDetails;

         // Fetch Transactions for today
         if(isset($requestParams['daterange'])){
            $dateArray = explode("-", $requestParams['daterange']);
            $params['startDate'] = $dateArray[0];
            $params['endDate'] = $dateArray[1];
        } else {
            $params['startDate'] = date("Y-m-d");
            $params['endDate'] = date("Y-m-d");
        }

        $params['walletID'] = $UserDetails['walletID'];

        $data['transactions'] = $this->getTransactions($params);

        $URI= $this->isAdminUser($UserDetails) ? '/admin/history' : '/dashboard';
    
        return view($URI)->with($data);
    }

    public function getTransactions($params){
        $transactionModel = new Transactions;
        
        $myTransactions =  $transactionModel->getFundingTransactionData($params);

        \Log::info("All Funding Transactions " . print_r($myTransactions, true));
        
        return $myTransactions;

    }

    public function fundWalletManually(Request $request){
        
        $data = parseRequest($request, true);
        $UserDetails = $_SESSION['UserDetails'];
        
        $data['sessiondata'] = $UserDetails;

        $transactionModel = new Transactions;

        $valPin = AuthController::validateUserPin($data);
        if($valPin === false){
            $status = "failure";
            $data = "Invalid Wallet PIN. Please try again";
            return $this->returnOutput($status,$data);
        } 

        if($data['type'] == "refund"){
            $transaction = $transactionModel->getAllTransactionDataViaReference($data['reference']);
            if($transaction == false){
                $status = "failure";
                $data = "Invalid Transaction Reference for Refund";
                return $this->returnOutput($status,$data);
            }
        }

        // Credit the wallet
        $fundResponse = WalletController::creditWallet($data['amount'], $data['walletID']);

        if($fundResponse == true){

            $this->prepareTransactionRecords($data);

            $status = "success";
            $data = strtoupper($data['type']) . " of N$data[amount] Successful";
            return $this->returnOutput($status,$data);

        } else {
            $status = "failure";
            $data = "Process failed. Please contact admin support";
            return $this->returnOutput($status,$data);
        }

    }

    private function prepareTransactionRecords($data){
        $data['category'] = "MNFD";
        $data['phonenumber'] = $data['sessiondata']['phonenumber'];
        $data['service'] = $data['type'];
        $data['remark'] = $data['reference'];
        TransactionsController::appendTransaction($data);
    }



}