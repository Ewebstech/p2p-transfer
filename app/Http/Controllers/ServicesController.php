<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;



class ServicesController extends Controller
{
    protected $helper;
    
    public function __construct()
    {
               
    }
    
    public function index(Request $request){

        $UserDetails = $_SESSION['UserDetails'];
        $data['sessiondata'] = $UserDetails;        
   
        $URI= '/services';
        return view($URI)->with($data);
    }

    public function confirmPurchase(Request $request){

        $UserDetails = $_SESSION['UserDetails'];
        $data['sessiondata'] = $UserDetails;        
   
        $URI= '/confirm-purchase';
        return view($URI)->with($data);
    }

    public function payment(Request $request){

        $UserDetails = $_SESSION['UserDetails'];
        $data['sessiondata'] = $UserDetails;        
   
        $URI= '/payment';
        return view($URI)->with($data);
    }

    public function paymentCompleted(Request $request){

        $UserDetails = $_SESSION['UserDetails'];
        $data['sessiondata'] = $UserDetails;        
   
        $URI= '/payment-complete';
        return view($URI)->with($data);
    }


}