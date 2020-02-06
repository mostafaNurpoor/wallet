<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\User\UserRepository;
use App\Http\Responses\GeneralResponse ;

class AuthController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user )
    {
        $this->user = $user;
    }

    public function signUp(Request $request)
    {

    }

    public function logIn(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',
            'OTP' => 'required|string',
        ]);

        $logIn = $this->user->getUserData($request->phone_number , $request->OTP);

        if ($logIn['success'] == 1){

            // hash checked and it is match

            $token = Self::createTokenPassport($request->phone_number , $request->OTP);

        } else if ($logIn['success']  == 2){

            // hash checked and it not match

            $token= 'not match';

        }

        return $token ;

    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        $message = 'Successfully logged out' ;

        return GeneralResponse::success($message) ;
    }

    public function createTokenPassport($phoneNumber, $OTP)
    {
        $guzzle = new \GuzzleHttp\Client;

        $secretToken = User::secretToken ;

        $clientId = User::clientId ;

        $response = $guzzle->post(url('/oauth/token'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $clientId,
                'client_secret' => $secretToken,
                'username'      => $phoneNumber,
                'password'      => $OTP
            ],
        ]);

        return $response ;
    }

    public function userData(Request $request)
    {
        return $request->user();
    }

}
