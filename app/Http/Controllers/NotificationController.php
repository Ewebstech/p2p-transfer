<?php
namespace App\Http\Controllers;
use App\Models\Transactions;
use Illuminate\Http\Request;
use App\Http\Controllers\Generator;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;


class NotificationController
{

    public static function SendEmailNotification($transactionData, $UserDetails){

        $Mailer = new MailController;

        $status = $transactionData['error'] == false ? "successful" : "failed";
        $category = ucwords($transactionData['data']['category']);
        
        if($category == "Airtime"){
            // Send Email to User
            $mailParams = [
                'Name' => $UserDetails['fullname'],
                'Email' => $UserDetails['email'],
                'service' => strtoupper($transactionData['data']['service']),
                'category' => $category,
                'phonenumber' => $transactionData['data']['phonenumber'],
                'amount' => $transactionData['data']['amount'],
                'phonenumber' => $transactionData['data']['phonenumber'],
                'date' => date("d F, Y"),
                'reference' => $transactionData['data']['reference'],
                'Subject' => 'Recharge Reciept - '. strtoupper($transactionData['data']['service']),
                'status' => $status,
                'template' => 'airtime'
            ];

            $sendMail = $Mailer->sendMail($mailParams);
            \Log::info("Email Notification Response to : " . $UserDetails['email'] . " " . $sendMail);
        }
        

    }



}