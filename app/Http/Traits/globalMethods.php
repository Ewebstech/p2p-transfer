<?php

namespace App\Http\Traits;

use GuzzleHttp\Client as GuzzleClient;
use App\Helpers\customCode;


Trait globalMethods {

    protected $apiUrl;
    protected $apiUsername;
    protected $apiKey;
    private $client;

    public function __construct(){

    }

    protected function prepareParams(){

        $this->client = new GuzzleClient();
    }

    protected function formatAmount($amount){
        return (int) $amount ?? 0;
    }


    protected function generateClientId(){
        $generatedID = $this->generateDefaultStaticPassword(6);
        $Resource = new Users;
        $user = $Resource->getUserById($generatedID);

        $staffID = $user['client_id'];
        if($staffID == null){
            $ID = $generatedID;
        } else {
            $this->generateClientId();
        }

        return $ID;
    }

    protected function arraylize($payload){
        if(is_object($payload)){
            $arraylized = $payload->toArray();
        } else {
            $arraylized = $payload;
        }
        return $arraylized;
    }

    protected function jsonToArray($data) {
        $Content = json_decode($data, true);
        return $Content;
    }
    /**
     * Time Function
     */
    protected function time_ago($time) {
        $TIMEBEFORE_NOW =  'Just now';
        $TIMEBEFORE_MINUTE = '{num} minute ago';
        $TIMEBEFORE_MINUTES = '{num} minutes ago';
        $TIMEBEFORE_HOUR = '{num} hour ago';
        $TIMEBEFORE_HOURS = '{num} hours ago';
        $TIMEBEFORE_YESTERDAY = 'yesterday';
        $TIMEBEFORE_FORMAT = '%e %b';
        $TIMEBEFORE_FORMAT_YEAR = '%e %b, %Y';
        $TIMEBEFORE_DAYS = '{num} days ago';
        $TIMEBEFORE_WEEK = '{num} week ago';
        $TIMEBEFORE_WEEKS = '{num} weeks ago';
        $TIMEBEFORE_MONTH =  '{num} month ago';
        $TIMEBEFORE_MONTHS = '{num} months ago';
        $out = ''; // what we will print out
        $now = time(); // current time
        $diff = $now - $time; // difference between the current and the provided dates

        if ($diff < 60) // it happened now
        {
            return $TIMEBEFORE_NOW;
        } elseif ($diff < 3600) // it happened X minutes ago
        {
            return str_replace('{num}', ($out = round($diff / 60)), $out == 1 ? $TIMEBEFORE_MINUTE : $TIMEBEFORE_MINUTES);
        } elseif ($diff < 3600 * 24) // it happened X hours ago
        {
            return str_replace('{num}', ($out = round($diff / 3600)), $out == 1 ? $TIMEBEFORE_HOUR : $TIMEBEFORE_HOURS);
        } elseif ($diff < 3600 * 24 * 2) // it happened yesterday
        {
            return $TIMEBEFORE_YESTERDAY;
        } elseif ($diff < 3600 * 24 * 7) {
            return str_replace('{num}', round($diff / (3600 * 24)), $TIMEBEFORE_DAYS);
        } elseif ($diff < 3600 * 24 * 7 * 4) {
            return str_replace('{num}', ($out = round($diff / (3600 * 24 * 7))), $out == 1 ? $TIMEBEFORE_WEEK : $TIMEBEFORE_WEEKS);
        } elseif ($diff < 3600 * 24 * 7 * 4 * 12) {
            return str_replace('{num}', ($out = round($diff / (3600 * 24 * 7 * 4))), $out == 1 ? $TIMEBEFORE_MONTH : $TIMEBEFORE_MONTHS);
        } else // falling back on a usual date format as it happened later than yesterday
        {
            return strftime(date('Y', $time) == date('Y') ? $TIMEBEFORE_FORMAT : $TIMEBEFORE_FORMAT_YEAR, $time);
        }

    }



}
