<?php

namespace App\Models;
use MongoDB\BSON\UTCDateTime as MongoDate;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Dataplans extends Eloquent
{
    protected $connection = "mongodb";
    protected $collection = 'data_plans';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'data_volume', 'price', 'product_code', 'service'
    ];

    protected $model;

       
    public function fetchDataPlans($network){
        $data = $this->where('service', $network)->get();
        return ($data) ? $data->toArray() : false;
    }

    public static function getDataPlanAmount($code){
        $data = self::where('product_code', $code)->first();
        return ($data) ? $data->toArray() : false;
    }


}