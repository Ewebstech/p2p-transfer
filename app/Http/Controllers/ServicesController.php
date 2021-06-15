<?php
namespace App\Http\Controllers;
use App\Models\TvPlans;
use App\Models\Dataplans;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\Services\TV\Multichoice;

class ServicesController extends Controller
{
    protected $helper;

    public function transferToPeer(Request $request)
    {
        $data = parseRequest($request, true);
        try {
            $amount = (int) $data['amount'];
            $walletID = $params['walletId'];
            $pin = $data['pin'];
            $recieverWalletId = $data['rwalletId'];

            // Validate PIN
            $valPin = AuthController::validateUserPin($pin, $walletID);
            if ($valPin === false) {
                $msg = 'Invalid Wallet PIN. Please try again';
                return \standardResponse(false, $msg);
            }

            // Check Wallet Balance
            $checkWalletBalance = WalletController::checkWalletBalance(
                $amount,
                $walletID
            );
            if ($checkWalletBalance === false) {
                $msg = 'Insufficient Wallet Balance, Please fund your wallet!';
                return \standardResponse(false, $msg);
            }

            // Start Transaction
            $transactionData = TransactionsController::beginTransaction($data);
            if ($transactionData === false) {
                $msg = 'Transaction Error. Please Retry after 5mins';
                return \standardResponse(false, $msg);
            }

            // Debit Wallet
            $debitWallet = WalletController::debitWallet($amount, $walletID);

            // Credit reciever's wallet
            $creditWallet = WalletController::creditWallet(
                $amount,
                $recieverWalletId
            );

            if ($creditWallet) {
                $msg = 'Transfer of N' . $amount . ' is successful';

                $updateData = [
                    'error' => false,
                    'reference' => $transactionData['reference'],
                ];
                // Update Transaction
                TransactionsController::updateTransactionStatus(
                    $serviceResponse
                );

                return \standardResponse(true, $msg);
            } else {
                $msg =
                    'Transfer of N' . $amount . ' failed. Please retry later';

                $updateData = [
                    'error' => true,
                    'reference' => $transactionData['reference'],
                ];
                // Update Transaction
                TransactionsController::updateTransactionStatus(
                    $serviceResponse
                );

                return \standardResponse(false, $msg);
            }
        } catch (\Exception $e) {
            $exceptionDetails = [
                'message' => $e->getMessage(),
                'file' => basename($e->getFile()),
                'line' => $e->getLine(),
                'type' => class_basename($e),
            ];

            \Log::info(
                'Exception Occured During Transfers: ' .
                    print_r($exceptionDetails, true)
            );

            $msg = 'Unknown Status. Please contact support before retry!';
            return \standardResponse(false, $msg);
        }
    }
}
