<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Services\Airtime\Glo;
use App\Http\Controllers\Services\Airtime\Mtn;
use App\Http\Controllers\Services\Data\GloData;
use App\Http\Controllers\Services\Data\MtnData;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\Services\Airtime\Airtel;
use App\Http\Controllers\Services\Data\AirtelData;
use App\Http\Controllers\Services\Airtime\Etisalat;
use App\Http\Controllers\Services\Data\EtisalatData;



class ProviderController extends Controller
{
    protected $helper;

    
    public static function callService($transactionData){
        \Log::info("Transaction Data" . print_r($transactionData, true));
        if($transactionData['service'] == "mtn"){
            if($transactionData['category'] == "airtime"){
                return Mtn::purchaseAirtime($transactionData);
            }

            if($transactionData['category'] == "data"){
                return MtnData::purchaseData($transactionData);
            }
        }

        if($transactionData['service'] == "airtel"){
            if($transactionData['category'] == "airtime"){
                return Airtel::purchaseAirtime($transactionData);
            }

            if($transactionData['category'] == "data"){
                return AirtelData::purchaseData($transactionData);
            }
        }

        if($transactionData['service'] == "9mobile"){
            if($transactionData['category'] == "airtime"){
                return Etisalat::purchaseAirtime($transactionData);
            }

            if($transactionData['category'] == "data"){
                return EtisalatData::purchaseData($transactionData);
            }
        }

        if($transactionData['service'] == "glo"){
            if($transactionData['category'] == "airtime"){
                return Glo::purchaseAirtime($transactionData);
            }

            if($transactionData['category'] == "data"){
                return GloData::purchaseData($transactionData);
            }
        }
    }

}