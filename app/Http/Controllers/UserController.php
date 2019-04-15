<?php

namespace App\Http\Controllers;

use App\Common\Auto\JwtAuth;
use App\Common\Err\ApiErrDesc;
use App\Exceptions\ApiException;
use App\Http\Response\ResponseJson;
use App\User;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{

    use ResponseJson;

    public function info()
    {
        $jwtAuth = JwtAuth::getInstance();
        $uid = $jwtAuth->getUid();

        $user= User::where('id',$uid)->first();

        if (!$user){
            throw new ApiException(ApiErrDesc::ERR_USER_NOT_EXIST);
        }

        return $this->jsonSuccessData(
            [
                'name' => $user->name,
                'email' => $user->email,
            ]
        );
    }
}
