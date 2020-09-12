<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Services\Airtime\Mtn;
use App\Http\Controllers\TransactionsController;



class ProviderController extends Controller
{
    protected $helper;

    
    public static function callService($transactionData){
        \Log::info("Transaction Data" . print_r($transactionData, true));
        if($transactionData['service'] == "mtn"){
            return Mtn::purchaseAirtime($transactionData);
        }
    }

}