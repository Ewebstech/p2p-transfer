<?php

namespace App\Models;
use MongoDB\BSON\UTCDateTime as MongoDate;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TvPlans extends Eloquent
{
    protected $connection = "mongodb";
    protected $collection = 'tv_plans';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'package', 'price', 'product_code', 'service'
    ];

    protected $model;

       
    public function fetchTvPlans($network){
        $data = $this->where('service', $network)->get();
        return ($data) ? $data->toArray() : false;
    }
    

    public static function getTvPlanAmount($code){
        $data = self::where('product_code', $code)->first();
        return ($data) ? $data->toArray() : false;
    }


}