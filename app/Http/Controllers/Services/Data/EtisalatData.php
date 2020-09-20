<?php
namespace App\Http\Controllers\Services\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleClient;


class EtisalatData 
{
    protected static $apiUrl;
    protected static $apiKey;
    protected static $apiUsername;
    protected static $client;
    protected static $provider;
    protected static $env;
    protected static $returnUrl;
    protected static $dataMarkupAmount;
   
    
    public static function prepareParams(){
        self::$apiUrl = env('MOBILE_NIG_API_URL', 'https://mobilenig.com/API');
        self::$apiKey = env('MOBILENIG_APIKEY');
        self::$apiUsername= env('MOBILENIG_USERNAME');
        self::$client = new GuzzleClient();
        self::$provider = env('AirtimeProvider', 'MobileNig');
        self::$env = env('Environment', 'test');
        self::$returnUrl = env('RETURN_URL', 'https://blossompay.com.ng/callback');
        self::$dataMarkupAmount = (int) env('Dataplanmarkup', 100);

    }

    public static function purchaseData($transactionData){
        self::prepareParams();

        try{

            if(self::$provider == "MobileNig"){

                $parameters = [
                    'headers' => [
                        'Content-Type' =>'application/json'
                    ],
                    'timeout' => 8
                ];
        
                $price = $transactionData['amount'] - self::$dataMarkupAmount;

                if(self::$env == "test"){
                    $requestString = self::$apiUrl . "/data_test?username=".self::$apiUsername."&api_key=".self::$apiKey."&network=".$transactionData['service']."&phoneNumber=".$transactionData['phonenumber']."&product_code=".$transactionData['dataplan']."&price=".$price."&trans_id=".$transactionData['reference']."&return_url=".self::$returnUrl;
                } else {
                    $requestString = self::$apiUrl . "/data?username=".self::$apiUsername."&api_key=".self::$apiKey."&network=".$transactionData['service']."&phoneNumber=".$transactionData['phonenumber']."&product_code=".$transactionData['dataplan']."&price=".$price."&trans_id=".$transactionData['reference']."&return_url=".self::$returnUrl;
                }
                
                \Log::info("Sending Service Request to " . self::$provider . ": $requestString " . print_r($parameters, true));

                $clientResponse = self::$client->request('GET', $requestString , $parameters);
                $code = $clientResponse->getStatusCode();
                $theirResponse = $clientResponse->getBody()->getContents();
                $apiResponse = json_decode($theirResponse, true);
    
                \Log::info("Service Response from " . self::$provider . ": " . print_r($apiResponse, true));
                if(isset($apiResponse['code'])){
                    
                    $response = [
                        'error' => true,
                        'message' => $apiResponse['description'],
                        'data' => $transactionData
                    ];

                } else {

                    if(self::$env == "test"){

                        $response = [
                            'error' => false,
                            'message' => "Transaction Approved",
                            'data' => array_merge($transactionData, $apiResponse)
                        ];

                    } else {

                        $queryResponse = self::queryAirtime($transactionData);
                        if(isset($queryResponse['code'])){
                            $response = [
                                'error' => true,
                                'message' => $queryResponse['description'],
                                'data' => $transactionData
                            ];
                        } else {
                            $response = [
                                'error' => false,
                                'message' => "Transaction Approved",
                                'data' => array_merge($transactionData, $queryResponse)
                            ];
                        }

                    }

                }

                return $response;
            }        

        } catch(\Exception $e){
            
            $exceptionDetails = [
				'message' => $e->getMessage(),
				'file' => basename($e->getFile()),
				'line' => $e->getLine(),
				'type' => class_basename($e)
            ];
            
            \Log::info("Exception occured during service status check: " .  print_r($exceptionDetails, true));
    
            $response = [
                'error' => true,
                'message' => "System Error. Please confirm e-reciept before retry!",
                'data' => $transactionData
            ];

        }
    }

    private static function queryAirtime($transactionData){
        $parameters = [
            'headers' => [
                'Content-Type' =>'application/json'
            ],
            'timeout' => 20
        ];

        if(self::$env == "test"){
            $requestString = self::$apiUrl . "/airtime_premium_query?username=".self::$apiUsername."&api_key=".self::$apiKey."&trans_id=".$transactionData['reference'];
        } else {
            $requestString = self::$apiUrl . "/airtime_premium_query?username=".self::$apiUsername."&api_key=".self::$apiKey."&trans_id=".$transactionData['reference'];
        }
        
        \Log::info("Sending Service Query to " . self::$provider . ": $requestString " . print_r($parameters, true));

        $clientResponse = self::$client->request('GET', $requestString , $parameters);
        $code = $clientResponse->getStatusCode();
        $theirResponse = $clientResponse->getBody()->getContents();
        $apiResponse = json_decode($theirResponse, true);

        \Log::info("Service Query Response from " . self::$provider . ": " . print_r($apiResponse, true));
        
        return $apiResponse;
    }

}