<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\WalletController;

class DashboardController extends Controller
{
    protected $helper;

    public function __construct()
    {
               
    }
    
    public function index(Request $request){

        $UserDetails = $_SESSION['UserDetails'];
        $data['sessiondata'] = $UserDetails; 

        // Fetch Wallet Balance

        $data['sessiondata']['walletBalance'] = WalletController::getWalletBalance($UserDetails['walletID'])['balance'];
        
        \Log::info("Session Data: ". print_r($data, true));
        
        $URI= '/dashboard';
        return view($URI)->with($data);
    }


}