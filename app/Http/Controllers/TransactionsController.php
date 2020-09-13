<?php
namespace App\Http\Controllers;
use App\Models\Transactions;
use Illuminate\Http\Request;
use App\Http\Controllers\Generator;
use App\Http\Controllers\AuthController;


class TransactionsController extends Controller
{
    protected $helper;
    

    public function getTransactionHistoryPage(Request $request){

        $requestParams = parseRequest($request, true);

        $UserDetails = $_SESSION['UserDetails'];
        $data['sessiondata'] = $UserDetails;

        \Log::info("User data " . print_r($UserDetails, true));

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
        $URI= '/order-history';
        return view($URI)->with($data);
    }

    public function getTransactions($params){
        $transactionModel = new Transactions;
        $myTransactions =  $transactionModel->getTransactionDataViaWalletIDWithDateRange($params);
        return $myTransactions;
        \Log::info("My Transactions " . print_r($myTransactions, true));
    }

    public static function beginTransaction($data){
       
        $transactionData = self::buildTransactionData($data);
        
        $transactionModel = new Transactions;
        $saveData = $transactionModel->initializeTransactionData($transactionData);
        if($saveData){
            \Log::info("Transaction Initialized Successfully with data: " . print_r($transactionData, true));
            return $transactionData;
        } else {
            \Log::info("Transaction Failed to Initialized with data: " . print_r($transactionData, true));
            return $saveData;
        }
        
    }

    public static function buildTransactionData($data){
        $transactionData = [];

        if(isset($data['paymentData']['category']) && $data['paymentData']['category'] == "airtime"){
            $transactionData['category'] = $data['paymentData']['category'];
            $transactionData['service'] = $data['paymentData']['network'];
            $transactionData['walletID'] = $data['sessiondata']['walletID'];
            $transactionData['reference'] = "BLP".strtoupper(Generator::generateSecureRef(9));
            $transactionData['phonenumber'] = $data['paymentData']['phone'];
            $transactionData['amount'] = (int) $data['paymentData']['amount'];
            $transactionData['status'] = "pending";
        }

        if(isset($data['category']) && $data['category'] == "funding"){
            $transactionData['category'] = $data['category'];
            $transactionData['service'] = "card-fund";
            $transactionData['walletID'] = $data['walletID'];
            $transactionData['reference'] = $data['reference'];
            $transactionData['phonenumber'] = $data['phonenumber'];
            $transactionData['amount'] = (int) $data['amount'];
            $transactionData['status'] = "pending";
        }

        //\Log::info("TranData: " . print_r($transactionData, true));
        return $transactionData;
    }


    public static function updateTransactionStatus($data){
        
        //\Log::info("Transaction Data: " . print_r($data, true));
  
        $status = $data['error'] == false ? "successful" : "failed";
        
        $actualPrice = (int) isset($data['data']['details']['price']) ? $data['data']['details']['price'] : 0;
        $commission = $data['data']['amount'] - $actualPrice;
        $params = [
            'status' => $status,
            'fee' => $data['fee'] ?? 0,
            'commission' => $commission
        ];

        $updateDetails = [
            'reference' => $data['data']['reference'],
            'data' => $params
        ];

        $transactionModel = new Transactions;
        $updateTransaction = $transactionModel->updateTransactionData($updateDetails);
        if($updateTransaction){
            \Log::info("Transaction Updated Successfully");
        } else {
            \Log::info("Transaction Failed to Update");
        }
    }

    public static function findDuplicateTransactions($reference){
        $transactionModel = new Transactions;
        $check = $transactionModel->getTransactionDataViaReference($reference);
        if($check == false){
            \Log::info("Transaction exists");
            return false;
        } else {
            \Log::info("Transaction not exists");
            return true;
        }
    }
  
}