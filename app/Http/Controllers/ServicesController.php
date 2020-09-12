<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\TransactionsController;



class ServicesController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->provider = "MobileNig";
    }
    
    public function index(Request $request){

        $UserDetails = $_SESSION['UserDetails'];
        $data['sessiondata'] = $UserDetails;        
   
        

        $URI= '/services';
        return view($URI)->with($data);
    }

    public function confirmPurchase(Request $request){

        $data = parseRequest($request, true);
        $data['amount'] = $this->formatAmount($data['amount']);
        $UserDetails = $_SESSION['UserDetails'];
        $data['sessiondata'] = $UserDetails;  

        
        // if($data['category'] == "airtime"){
        //     if($data['network'] == "mtn"){
        //         $providerBalanceData = $this->getBalance($this->provider);
        //         $providerBalance = (int) $providerBalanceData['balance'];
        //         \Log::info("Provider Balance: " . print_r($providerBalanceData, true));

        //         if($providerBalanceData['error'] == true || $providerBalance < $data['amount']){
        //             return redirect('services')->with('error', 'Service Not Available. Please try again later');
        //         }

        //     }
        // }      
                
   
        $data['data'] = $data;
        $URI= '/confirm-purchase';
        return view($URI)->with($data);
    }

    public function payment(Request $request){

        $data = parseRequest($request, true);

        $UserDetails = $_SESSION['UserDetails'];
        $data['sessiondata'] = $UserDetails;  

        $data['paymentData'] = json_decode($data['data'], true);

        try{

            $amount = (int) $data['paymentData']['amount'];
            $walletID = $UserDetails['walletID'];

            // Validate PIN
            $valPin = AuthController::validateUserPin($data);
            if($valPin === false){
                $status = "failure";
                $data = "Invalid Wallet PIN. Please try again";
                return $this->returnOutput($status,$data);
            }

            // Check Wallet Balance
            $checkWalletBalance = WalletController::checkWalletBalance($amount, $walletID);
            if($checkWalletBalance === false){
                $status = "failure";
                $data = "Insufficient Wallet Balance, Please fund your wallet!";
                return $this->returnOutput($status,$data);
            }

            // Start Transaction
            $transactionData = TransactionsController::beginTransaction($data);
            if($transactionData === false){
                $status = "failure";
                $data = "Transaction Error. Please Retry after 5mins";
                return $this->returnOutput($status,$data);
            }

            // Debit Wallet
            $debitWallet = WalletController::debitWallet($amount, $walletID);

            // Call Provider
            $serviceResponse = ProviderController::callService($transactionData);
            \Log::info("Service Response: " . print_r($serviceResponse, true));

            if($serviceResponse['error'] == true){

                //Refund Wallet
                $refund = WalletController::creditWallet($amount, $walletID);

                $status = "failure";
                $url = null;
                $data = $serviceResponse['message'] ?? 'Transaction Failed';
                
            } else {
                $status = "success";
                $url = "/payment-complete?amount=".$amount."&reference=".$serviceResponse['data']['reference']."&phonenumber=".$serviceResponse['data']['phonenumber']."&date=".date("d-F-Y")."&status=success&service=".$serviceResponse['data']['service']."&category=".$serviceResponse['data']['category'];
                $data = $serviceResponse['message'] ?? 'Transaction Successful';
            }

            // Send Response
            $this->returnOutput($status,$data, $url);     
            

        } catch (\Exception $e){
            $exceptionDetails = [
				'message' => $e->getMessage(),
				'file' => basename($e->getFile()),
				'line' => $e->getLine(),
				'type' => class_basename($e)
            ];
            
            \Log::info("Exception Occured During Service: " .  print_r($exceptionDetails, true));

            $status = "failure";
            $data = "Exception. Please Retry";
            return $this->returnOutput($status,$data);
        }

        // Update Transaction
        TransactionsController::updateTransactionStatus($serviceResponse);
                
        NotificationController::SendEmailNotification($serviceResponse, $UserDetails);
        

    }

    public function paymentCompleted(Request $request){

        
        $data['page'] = $_REQUEST;
        $UserDetails = $_SESSION['UserDetails'];
        $data['sessiondata'] = $UserDetails;        
        
        \Log::info(print_r($data, true));

        $URI= '/payment-complete';
        return view($URI)->with($data);
    }


}