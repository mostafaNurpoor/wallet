<?php

namespace Modules\Wallet\Repositories\User ;

use App\User;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class UserRepositoryImpl implements UserRepository
{

    protected $user ;

    public function __construct(User $user)
    {
        $this->user = $user ;
    }

    public function registerUSer($name, $familyName, $phoneNumber, $email)
    {

    }

    public function updateOTP($phoneNumber, $OTPCode)
    {

    }

    public function ifUserExistByPhoneNumber($phoneNumber)
    {

    }

    public function getUserData($phoneNumber , $OTP)
    {
        $userData = $this->user::where($this->user::phone_number, $phoneNumber)->first();

        if (!$userData) {

            abort(404 , "user not found by this phone number");

        }

        if (Hash::check($OTP, $userData->OTP)) {

            // hash checked and it is match

            $data['success'] = '1';

        } else {

            // hash checked and it not match

            $data['success'] = '2';

        }

        return $data ;

    }

    public function updateData()
    {

    }
}
