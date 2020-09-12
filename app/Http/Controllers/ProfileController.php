<?php
namespace App\Http\Controllers;
use App\Models\Users;
use App\Models\Transactions;
use Illuminate\Http\Request;
use App\Http\Controllers\Generator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AuthController;

class ProfileController extends Controller
{
    protected $helper;
    

    public function getProfileData(Request $request){

        $requestParams = parseRequest($request, true);

        $UserDetails = $_SESSION['UserDetails'];
        $data['sessiondata'] = $UserDetails;

        $URI= '/profile';
        return view($URI)->with($data);
    }

    public function changePassword(Request $request){

        $requestParams = parseRequest($request, true);

        $UserDetails = $_SESSION['UserDetails'];

        $userModel = new Users;
        $userData = $userModel->getUserByWalletID($UserDetails['walletID']);

        if(isset($requestParams['existingPassword'])){
            //check if password matches
            if(Hash::check($requestParams['existingPassword'], $userData['password'])) {
                if($requestParams['newPassword'] == $requestParams['confirmPassword']){

                    $password = hash::make($requestParams['newPassword']);
                    $dataToUpdate = [
                        'password' => $password,
                        'pin' => $requestParams['pin']
                    ];

                    $updateUser = Users::where('walletID', $UserDetails['walletID'])->update($dataToUpdate);
                    if($updateUser){
                        $data['success'] = "Password Changed Successfully";
                    }

                } else {
                    $data['error'] = "New password and confirm password do not match!";
                }
            } else {
                $data['error'] = "Existing password is wrong";
            }
        }
        
        $data['sessiondata'] = $UserDetails;

        $URI= '/change-password';
        return view($URI)->with($data);
    }
   
}