<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Services\Airtime\Glo;
use App\Http\Controllers\Services\Airtime\Mtn;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\Services\Airtime\Airtel;
use App\Http\Controllers\Services\Airtime\Etisalat;



class ProviderController extends Controller
{
    protected $helper;

    
    public static function callService($transactionData){
        \Log::info("Transaction Data" . print_r($transactionData, true));
        if($transactionData['service'] == "mtn"){
            return Mtn::purchaseAirtime($transactionData);
        }

        if($transactionData['service'] == "airtel"){
            return Airtel::purchaseAirtime($transactionData);
        }

        if($transactionData['service'] == "9mobile"){
            return Etisalat::purchaseAirtime($transactionData);
        }

        if($transactionData['service'] == "glo"){
            return Glo::purchaseAirtime($transactionData);
        }
    }

}