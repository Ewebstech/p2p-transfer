<?php

namespace App\Models;
use MongoDB\BSON\UTCDateTime as MongoDate;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Transactions extends Eloquent
{
    protected $connection = "mongodb";
    protected $collection = 'transactions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'reference', 'walletID', 'amount', 'service', 'category', 'phonenumber', 'accountNo', 'status', 'fee', 'commission'
    ];

    protected $model;

    public function initializeTransactionData($data){

        $saveData = $this->create($data);
        return ($saveData) ? true : false;

    }

    public function updateTransactionData($data){
        $updateData = $this->where('reference', $data['reference'])->update($data['data']);
        return ($updateData) ? true : false;
    } 

    public function getTransactionDataViaWalletID($walletID){
        $data = $this->where('walletID', $walletID)->first();
        return ($data) ? $data->toArray() : false;
    }

    public function getTransactionDataViaWalletIDWithDateRange($params){

        $startDate = "";
        $endDate = "";

        if (isset($params['startDate'])) {
            $requestStartDate = date("Y-m-d", strtotime($params['startDate']));
            $startDate = new MongoDate(strtotime($requestStartDate . " 00:00:00") * 1000);
        }

        if (isset($params['endDate'])) {
            $requestEndDate = date("Y-m-d", strtotime($params['endDate']));
            $endDate = new MongoDate(strtotime($requestEndDate . " 23:59:59") * 1000);
        }
        
        $data = $this->where('walletID', $params['walletID'])
                    ->where('created_at', '>=', $startDate)
                    ->where('created_at', '<=', $endDate)
                    ->latest()
                    ->get();
        return ($data) ? $data->toArray() : [];
    }

    public function getTransactionDataViaReference($ref){
        $data = $this->where('reference', $ref)->first();
        return ($data) ? $data->toArray() : false;
    }

    public function getUserTransactions($walletID){
        $trans = $this->where('walletID',$walletID)->orderBy('created_at', 'DESC')->get();
        return ($trans) ? $trans->toArray() : false;
    }

}