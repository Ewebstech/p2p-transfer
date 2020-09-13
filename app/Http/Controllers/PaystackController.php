<?php
namespace App\Http\Controllers;

use App\Model\Users;
use App\Models\Payments;
use App\Models\MandateModel;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Helpers\HttpStatusCodes;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionsController;

class PaystackController extends Controller
{
    /**
     * Issue Secret Key from your Paystack Dashboard
     * @var string
     */
    protected $secretKey;

    protected $helper;

    public function __construct()
    {   
        if(!isset($_SESSION)) session_start();
        //$this->middleware('redirectauth');
    }
  
    public function genTranxRef()
    {
        return $this->getHashedToken(25);
    }

    private static function getPool($type = 'alnum')
    {
        switch ($type) {
            case 'alnum':
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'alpha':
                $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'hexdec':
                $pool = '0123456789abcdef';
                break;
            case 'numeric':
                $pool = '0123456789';
                break;
            case 'nozero':
                $pool = '123456789';
                break;
            case 'distinct':
                $pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
                break;
            default:
                $pool = (string)$type;
                break;
        }
        return $pool;
    }
    /**
     * Generate a random secure crypt figure
     * @param  integer $min
     * @param  integer $max
     * @return integer
     */
    public static function secureCrypt($min, $max)
    {
        $range = $max - $min;
        if ($range < 0) {
            return $min; // not so random...
        }
        $log = log($range, 2);
        $bytes = (int)($log / 8) + 1; // length in bytes
        $bits = (int)$log + 1; // length in bits
        $filter = (int)(1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    }
    /**
     * Finally, generate a hashed token
     * @param  integer $length
     * @return string
     */
    public static function getHashedToken($length = 25)
    {
        $token = "";
        $max = strlen(static::getPool());
        for ($i = 0; $i < $length; $i++) {
            $token .= static::getPool()[static::secureCrypt(0, $max)];
        }
        return $token;
    }

    public function redirectToProvider($params)
    {
        $metadata = $params;
        try {
            $totalAmount = ($params['amount'] * 100);
        } catch (\ErrorException $e) {
            Log::error($e->getMessage());
            return false;
        }
        $initializePayment = 'https://api.paystack.co/transaction/initialize';
        $authBearer = 'Bearer ' . $this->setKey();
        //dd($initializePayment);
     
        try {
            $response = Curl::to($initializePayment)
                            ->withData([
                                'reference' => $params['reference'],
                                'amount' => intval($totalAmount),
                                'email' =>  $params['email'],
                                'metadata' => $metadata,
                            ])
                            ->withHeader('Authorization: Bearer ' . $this->SetKey())
                            ->asJson()
                            ->post();
            $response = json_decode(json_encode($response));
            
            $authorizationUrl = $response->data->authorization_url;
            $params['url'] = $authorizationUrl;
                            
            $requestData = [
                'url' => $initializePayment,
                'authBearer' => $initializePayment,
                'params' => $params,
                'request' => $response
            ]; 
            Log::info('Redirecting Payment Request to Paystack: '. print_r($requestData, true));

            return $authorizationUrl;          

        } catch (\ErrorException $e) {
            Log::error('An error occured while making request to Paystack: '. $e->getMessage());
            return false;
        }
        
    }

    public function handleGatewayCallback(Request $request)
    {
        $transactionRef = request()->query('trxref');
        $verifyPayment = 'https://api.paystack.co/transaction/verify/' . $transactionRef;
        $response = Curl::to($verifyPayment)
            ->withHeader('Authorization: Bearer ' . $this->SetKey())
            ->get();
      
        $response = json_decode($response);
       
        \Log::info("Callback Response: " . print_r($response, true));

        if ($response->status === true) {
            // Save Transaaction Details
            $params = (array) $response->data;
            $params['metadata'] = (array) $response->data->metadata;            
            $params['data']['reference'] = $params['metadata']['reference'];
            $params['fee'] = (int) $params['fees']/100;
            $params['log'] = (array) $params['log'];
            $params['data']['amount'] = $params['amount']/100;
            $params['error'] = false;
            $params['amountToCredit'] = $params['metadata']['amountToCredit'];
            // Update Transaction
            TransactionsController::updateTransactionStatus($params);

            $alreadyCredited = TransactionsController::findDuplicateTransactions($params['data']['reference']);
            //\Log::info("Already credited log: " . print_r($alreadyCredited, true));

            if($alreadyCredited === true){ 
                // Fund my wallet
                //\Log::info("Funding Wallet" . print_r($params, true));
                WalletController::creditWallet($params['amountToCredit'], $params['metadata']['walletID']);
            }

            return redirect('fundmywallet')->with('status', 'Wallet Funding of N'. number_format($params['amountToCredit']) .' is Successful.');
            
        } else {
            $params['error'] = true;
            $params['data']['reference'] = $transactionRef;

            // Update Transaction
            TransactionsController::updateTransactionStatus($params);

            return redirect('fundmywallet')->with('failed', 'Wallet Funding of N'. number_format($params['data']['amount']) .' Failed.');

        }
    }

    /**
     * Check authorization code to know if they have funds for the payment you seek.
     */
    public function checkAuthorization($params)
    {
        \Log::info("Send Authorization Check Request for ". json_encode($params));
        $checkAuthUrl = 'https://api.paystack.co/transaction/check_authorization';
            $response = Curl::to($checkAuthUrl)
            ->withData([
                'authorization_code' => $params['auth_code'],
                'email' => $params['email'],
                'amount' =>  $params['amount']
            ])
            ->withHeader('Authorization: Bearer ' . $this->SetKey())
            ->asJson()
            ->post();

            $resp = (array) $response;
        
        if ($resp['status'] === true) {
            \Log::info("Authorization Check Response ". json_encode($resp));
            return $resp['status'];
        } else {
            \Log::info("Authorization Check Response ". json_encode($resp));
            return false;
        }
    }

    public function recurringDebit($params)
    {
        \Log::info("Sending Recurring Debit Request to Paystack for ". json_encode($params));
        $checkAuthUrl = 'https://api.paystack.co/transaction/charge_authorization';
            $response = Curl::to($checkAuthUrl)
            ->withData([
                'authorization_code' => $params['auth_code'],
                'email' => $params['email'],
                'amount' =>  $params['amount']
            ])
            ->withHeader('Authorization: Bearer ' . $this->SetKey())
            ->asJson()
            ->post();

            $resp = (array) $response;
        if ($resp['status'] === true) {
            \Log::info("Authorization Check Response ". json_encode($resp));
            $responseArray = (array) $resp['data'];
            return $responseArray;
        } else {
            \Log::info("Authorization Check Response ". json_encode($resp));
            return false;
        }
    }



    public function setKey()
    {
        $key = env('paystack_secret_key');
        return $key;
    }


}