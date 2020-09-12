<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Wallets extends Eloquent
{
    protected $connection = "mongodb";
    protected $collection = 'wallets';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'balance', 'walletID'
    ];

    protected $model;

    public function saveWalletData($data){
        
        $saveData = $this->create($data);
        return ($saveData) ? $saveData : false;

    }

    public function updateWalletData($data){
        $updateData = $this->where('walletID', $data['walletID'])->update($data['data']);
        return ($updateData) ? $updateData : false;
    } 

    public function getWalletData($walletID){
        $walletdata = $this->where('walletID', $walletID)->first();
        return ($walletdata) ? $walletdata->toArray() : false;
    }


}