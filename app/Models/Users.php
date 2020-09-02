<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Users extends Eloquent
{
    protected $connection = "mongodb";
    protected $collection = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'fullname', 'phonenumber', 'email', 'password', 'walletID', 'status'
    ];

    protected $model;

    public function saveUserDetails($data){
        
        $saveData = $this->create($data);
        return ($saveData) ? true : false;

    }

    public function getAllCustomers(){
        $user = $this->orderBy('created_at','desc')->get();
        return ($user) ? $user->toArray() : false;
    }

    public function getUser($email){
        $user = $this->where('email', $email)->first();
        return ($user) ? $user->toArray() : false;
    }

    public function getUserByPhoneNumber($phone){
        $user = $this->where('phonenumber', $phone)->first();
        return ($user) ? $user->toArray() : false;
    }

    public function updateUser($params){
        
        $updateData = $this->where('email', $params['email'])->update($params['data']);
        return ($updateData) ? true : false;
    }

    public function editCustomerDetails($params){
        $content = json_encode($params);
        
        $data = [
            'name' => ucwords($params['name']),
            'phonenumber' => $params['phonenumber'],
            'email' => strtolower($params['email']),
            'content' => $content
        ];

        $updateData = $this->where('id', $params['id'])->update($data);
        return ($updateData) ? true : false;
    
    }

    public function deleteRow($param){
        $user = $this->where('id', $param)->delete();
        return ($user) ? $user : false;
    }


}
