<?php
namespace App\Http\Controllers;
use App\Models\Transactions;
use Illuminate\Http\Request;
use App\Http\Controllers\Generator;
use App\Http\Controllers\AuthController;

class TransactionsController extends Controller
{
    protected $helper;

    public function getTransactionHistoryPage(Request $request)
    {
        $requestParams = parseRequest($request, true);

        // Fetch Transactions for today
        if (isset($requestParams['daterange'])) {
            $dateArray = explode('-', $requestParams['daterange']);
            $params['startDate'] = $dateArray[0];
            $params['endDate'] = $dateArray[1];
        } else {
            $params['startDate'] = date('Y-m-d');
            $params['endDate'] = date('Y-m-d');
        }

        $params['walletID'] = $requestParams['walletId'];

        $data['transactions'] = $this->getTransactions($params);

        return \standardResponse(
            true,
            'Transaction History Fetch Successful',
            $data['transactions']
        );
    }

    public function getTransactions($params)
    {
        $transactionModel = new Transactions();
        $myTransactions = $transactionModel->getTransactionDataViaWalletIDWithDateRange(
            $params
        );
        return $myTransactions;
        \Log::info('My Transactions ' . print_r($myTransactions, true));
    }

    public static function beginTransaction($data)
    {
        //\Log::info("begin data" . print_r($data, true));

        $transactionData = self::buildTransactionData($data);

        $transactionModel = new Transactions();
        $saveData = $transactionModel->initializeTransactionData(
            $transactionData
        );
        if ($saveData) {
            \Log::info(
                'Transaction Initialized Successfully with data: ' .
                    print_r($transactionData, true)
            );
            return $transactionData;
        } else {
            \Log::info(
                'Transaction Failed to Initialized with data: ' .
                    print_r($transactionData, true)
            );
            return $saveData;
        }
    }

    public static function buildTransactionData($data)
    {
        $transactionData = [];

        if (isset($data['category']) && $data['category'] == 'funding') {
            $transactionData['category'] = $data['category'];
            $transactionData['service'] = 'card-fund';
            $transactionData['walletID'] = $data['walletID'];
            $transactionData['reference'] = $data['reference'];
            $transactionData['phonenumber'] = $data['phonenumber'];
            $transactionData['amount'] = (int) $data['amount'];
            $transactionData['status'] = 'pending';
        }

        //\Log::info("TranData: " . print_r($transactionData, true));
        return $transactionData;
    }

    public static function updateTransactionStatus($data)
    {
        $status = $data['error'] == false ? 'successful' : 'failed';
        $params = [
            'status' => $status,
            'fee' => 0,
            'commission' => 0,
        ];

        $updateDetails = [
            'reference' => $data['reference'],
            'data' => $params,
        ];

        $transactionModel = new Transactions();
        $updateTransaction = $transactionModel->updateTransactionData(
            $updateDetails
        );
        if ($updateTransaction) {
            \Log::info('Transaction Updated Successfully');
        } else {
            \Log::info('Transaction Failed to Update');
        }
    }

    public static function findDuplicateTransactions($reference)
    {
        $transactionModel = new Transactions();
        $check = $transactionModel->getTransactionDataViaReference($reference);
        if ($check == false) {
            \Log::info('Transaction not exists');
            return false;
        } else {
            \Log::info('Transaction exists');
            return true;
        }
    }
}
