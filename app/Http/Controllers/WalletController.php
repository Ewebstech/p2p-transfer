<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Wallets;
use Illuminate\Http\Request;
use App\Helpers\HttpStatusCodes;
use App\Http\Controllers\Generator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PaystackController;
use App\Http\Controllers\TransactionsController;

class WalletController extends Controller
{
    public function fundWallet(Request $request)
    {
        $params = parseRequest($request, true);
        $params['walletID'] = getWalletId($params['phonenumber']);
        $params['category'] = 'funding';

        $params['reference'] =
            'FUND' . strtoupper(Generator::generateSecureRef(9));
        $amount = (int) $params['amount'];
        $charges = (1.5 / 100) * $amount;
        if ($charges > 2000) {
            $charges = 2000;
        }
        $params['amount'] = $amount + $charges;
        $params['amountToCredit'] = $amount;

        $paystack = new PaystackController();
        $paymentUrl = $paystack->redirectToProvider($params);

        if ($paymentUrl == false) {
            $msg = 'Error Occured Initializing Payments';
            return \standardResponse(false, $msg);
        } else {
            \Log::info(
                'Back from PaystackController --- Rerouting to Url : ' .
                    print_r($payment, true)
            );

            // Start Transaction
            $transactionData = TransactionsController::beginTransaction(
                $params
            );
            if ($transactionData === false) {
                $msg = 'Transaction Error. Please Retry after 5mins';
                return \standardResponse(false, $msg);
            }

            $msg =
                'Payment initialization successful. Please proceed with the url below to make payment';
            $data = [
                'url' => $paymentUrl,
            ];
            return \standardResponse(true, $msg, $data);
        }
    }

    public static function generateWalletId($walletString)
    {
        \Log::info('Generating Wallet ID .... ');
        $WalletID = substr($walletString, -10);
        \Log::info('Wallet ID Generated: ' . $WalletID);
        return $WalletID;
    }

    public function fetchMyBalance(Request $request)
    {
        $params = parseRequest($request, true);
        $data = $this->getWalletBalance($params['walletId']);
        return \standardResponse(true, 'Process Complete', $data);
    }

    public function getWalletBalance($walletID)
    {
        $WalletModel = new Wallets();
        $walletData = $WalletModel->getWalletData($walletID);
        if ($walletData !== false) {
            \Log::info('Balance Fetch Successful' . print_r($walletData, true));
            $response = [
                'balance' => (int) $walletData['balance'],
                'error' => false,
            ];
            return $response;
        } else {
            \Log::info(
                'Balance Not Available, Defaulting to 0' .
                    print_r($walletData, true)
            );

            $response = [
                'balance' => 0,
                'error' => false,
            ];
            return $response;
        }
    }

    public function checkWalletBalance(int $amount, $walletID)
    {
        $walletBalanceData = self::getWalletBalance($walletID);
        $walletBalance = $walletBalanceData['balance'];

        if ($walletBalance >= $amount) {
            return true;
        } else {
            return false;
        }
    }

    public static function creditWallet($amount, $walletID)
    {
        $WalletModel = new Wallets();
        $amountToCredit = (int) $amount;

        $isWalletData = $WalletModel->getWalletData($walletID);
        if ($isWalletData == false) {
            $data = [
                'walletID' => $walletID,
                'balance' => $amountToCredit,
            ];

            $walletCreditInfo = $WalletModel->saveWalletData($data);
            if ($walletCreditInfo) {
                \Log::info(
                    'Wallet Successfully Credited ' .
                        print_r($walletCreditInfo, true)
                );
                return true;
            } else {
                \Log::info(
                    'Wallet Credit Failed ' . print_r($walletCreditInfo, true)
                );
                return false;
            }
        } else {
            $previousBalance = (int) $isWalletData['balance'];
            $newBalance = $previousBalance + $amountToCredit;

            $data = [
                'balance' => $newBalance,
            ];

            $updateArray = [
                'data' => $data,
                'walletID' => $walletID,
            ];

            $walletCreditInfo = $WalletModel->updateWalletData($updateArray);

            if ($walletCreditInfo) {
                \Log::info("Wallet Successfully Credited with $amountToCredit");
                return true;
            } else {
                \Log::info('Wallet Credit Failed ');
                return false;
            }
        }
    }

    public static function debitWallet($amount, $walletID)
    {
        $WalletModel = new Wallets();
        $amountToDebit = (int) $amount;

        $isWalletData = $WalletModel->getWalletData($walletID);
        if ($isWalletData == false) {
            $response = [
                'balance' => 0,
                'error' => true,
            ];

            return $response;
        } else {
            $previousBalance = (int) $isWalletData['balance'];
            $newBalance = $previousBalance - $amountToDebit;

            $data = [
                'balance' => $newBalance,
            ];

            $updateArray = [
                'data' => $data,
                'walletID' => $walletID,
            ];

            $updateDebitInformation = $WalletModel->updateWalletData(
                $updateArray
            );

            if ($updateDebitInformation) {
                \Log::info(
                    'Wallet Successfully Debited: ' .
                        print_r($updateDebitInformation, true)
                );

                $response = [
                    'balance' => $newBalance,
                    'error' => false,
                ];

                return $response;
            } else {
                \Log::info(
                    'Wallet Debit Failed ' .
                        print_r($updateDebitInformation, true)
                );

                $response = [
                    'balance' => $previousBalance,
                    'error' => true,
                ];

                return $response;
            }
        }
    }
}
