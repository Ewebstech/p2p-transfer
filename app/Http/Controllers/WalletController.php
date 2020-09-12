<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Wallets;
use App\Mail\resetPassword;
use App\ResetPasswordToken;
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

class WalletController extends Controller
{

    public function fundWalletPage(Request $request){        
        $data['page'] = $_REQUEST;
        $UserDetails = $_SESSION['UserDetails'];
        $data['sessiondata'] = $UserDetails;        
        
        \Log::info(print_r($data, true));

        $URI= '/fundmywallet';
        return view($URI)->with($data);
    }

    public function takePayment(Request $request){
        $params = parseRequest($request, true);
        $UserDetails = $_SESSION['UserDetails'];
        $params['walletID'] = $UserDetails['walletID'];
        $params['email'] = $UserDetails['email'];
        $params['category'] = "funding";
        $params['phonenumber'] = $UserDetails['phonenumber'];
        $params['reference'] = "BLPFUND".strtoupper(Generator::generateSecureRef(9));
        $amount = (int) $params['amount'];
        $charges = 1.5/100 * $amount;
        if($charges > 2000){
            $charges = 2000;
        }
        $params['amount'] = $amount + $charges;
        $params['amountToCredit'] = $amount;

        $paystack = new PaystackController;
        $payment = $paystack->redirectToProvider($params);
        
        if($payment == false){
            $status = "error";
            $data = $payment['message'] ?? "Error Occured Initializing Payments";
            return $this->returnOutput($status,$data);
        } else {
            \Log::info("Back from PaystackController --- Rerouting to Url : ". print_r($payment, true));
  
            // Start Transaction
            $transactionData = TransactionsController::beginTransaction($params);
            if($transactionData === false){
                $status = "failure";
                $data = "Transaction Error. Please Retry after 5mins";
                return $this->returnOutput($status,$data);
            }

            $status = 'success';
            $url = $payment;
            $data = 'Payment Initialized...Redirecting to Payment Provider';
            return $this->returnOutput($status,$data,$url);
            
        }

        
    }


    public static function generateWalletId($walletString){
        \Log::info("Generating Wallet ID .... ");
        $WalletID = substr($walletString, -10);
        \Log::info("Wallet ID Generated: " . $WalletID);
        return $WalletID;
    }

    public static function getWalletBalance($walletID){

        $WalletModel = new Wallets;
        $walletData = $WalletModel->getWalletData($walletID);
        if($walletData !== false){
            \Log::info("Balance Fetch Successful" . print_r($walletData, true));
            $response = [
                'balance' => (int) $walletData['balance'],
                'error' => false
            ];
            return $response;
        } else {
            \Log::info("Balance Not Available, Defaulting to 0" . print_r($walletData, true));

            $response = [
                'balance' => 0,
                'error' => false
            ];
            return $response;
        }

    } 

    public static function checkWalletBalance(int $amount, $walletID){
        $walletBalanceData = self::getWalletBalance($walletID);
        $walletBalance = $walletBalanceData['balance'];
        
        if($walletBalance >= $amount){
            return true;
        } else {
            return false;
        }
    } 

    public static function creditWallet($amount, $walletID){

        $WalletModel = new Wallets;
        $amountToCredit = (int) $amount;
       
        $isWalletData = $WalletModel->getWalletData($walletID);
        if($isWalletData == false){

            $data = [
                'walletID' => $walletID,
                'balance' => $amountToCredit
            ];

            $walletCreditInfo = $WalletModel->saveWalletData($data);
            if($walletCreditInfo){
                \Log::info("Wallet Successfully Credited " . print_r($walletCreditInfo, true));
            } else {
                \Log::info("Wallet Credit Failed " . print_r($walletCreditInfo, true));
            }
            
        } else {

            $previousBalance = (int) $isWalletData['balance'];
            $newBalance = $previousBalance + $amountToCredit;

            $data = [
                'balance' => $newBalance
            ];

            $updateArray = [
                'data' => $data,
                'walletID' => $walletID
            ];

            $WalletModel->updateWalletData($updateArray);
        }

    }

    public static function debitWallet($amount, $walletID){

        $WalletModel = new Wallets;
        $amountToDebit = (int) $amount;
        
        $isWalletData = $WalletModel->getWalletData($walletID);
        if($isWalletData == false){

            $response = [
                'balance' => 0,
                'error' => true
            ];

            return $response;
            
        } else {

            $previousBalance = (int) $isWalletData['balance'];
            $newBalance = $previousBalance - $amountToDebit;

            $data = [
                'balance' => $newBalance
            ];

            $updateArray = [
                'data' => $data,
                'walletID' => $walletID 
            ];

            $updateDebitInformation = $WalletModel->updateWalletData($updateArray);

            if($updateDebitInformation){

                \Log::info("Wallet Successfully Debited: " . print_r($updateDebitInformation, true));
                
                $response = [
                    'balance' => $newBalance,
                    'error' => false
                ];

                return $response;

            } else {

                \Log::info("Wallet Debit Failed " . print_r($updateDebitInformation, true));

                $response = [
                    'balance' => $previousBalance,
                    'error' => true
                ];

                return $response;

            }


        }

    }

}