<?php

namespace App\Http\Controllers;


use App\Common\Err\ApiErrDesc;
use App\Exceptions\ApiException;
use App\User;
use Illuminate\Http\Request;
use App\Common\Auto\JwtAuth;
use App\Http\Response\ResponseJson;
use Illuminate\Routing\Controller as BaseController;

class JwtLoginController extends BaseController
{

    use ResponseJson;

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $re = User::where('email', $email)->first();

        if (!$re) {
            throw new ApiException(ApiErrDesc::ERR_USER_NOT_EXIST);
        } else {
            $userPasswordHash = $re['password'];

            if (password_verify($password, $userPasswordHash)) {
                throw new ApiException(ApiErrDesc::ERR_PASSWORD);
            } else {
                $jwtAuth = JwtAuth::getInstance();
                $token = $jwtAuth->setUid(1)->encode()->getToken();

                return $this->jsonSuccessData(
                    [
                        'token' => $token,
                        'name' => $re['name'],
                        'email' => $re['email'],
                    ]
                );
            }
        }


    }
}
