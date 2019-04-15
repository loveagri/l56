<?php

namespace App\Http\Controllers;

use App\Common\Auto\JwtAuth;
use App\Common\Err\ApiErrDesc;
use App\Exceptions\ApiException;
use App\Http\Response\ResponseJson;
use App\User;
use Illuminate\Support\Facades\Redis;

class UserController extends UserBaseController
{

    use ResponseJson;

    public function info()
    {
        $jwtAuth = JwtAuth::getInstance();
        $uid = $jwtAuth->getUid();

        $user = User::where('id', $uid)->first();

        if (!$user) {
            throw new ApiException(ApiErrDesc::ERR_USER_NOT_EXIST);
        }

//        return $this->jsonSuccessData(
//            [
//                'name' => $user->name,
//                'email' => $user->email,
//            ]
//        );
    }

    public function infoWithCache()
    {
        $cacheUserInfo = Redis::get('uid:'.$this->uid);
        if (!$cacheUserInfo) {
            $user = User::where('id', 1)->first();
            if (!$user) {
                throw new ApiException(ApiErrDesc::ERR_USER_NOT_EXIST);
            }

            Redis::setex('uid:'.$this->uid, 3600, json_encode($user->toArray()));


        } else {
            $user = json_decode($cacheUserInfo);
        }

//        return $this->jsonSuccessData(
//            [
//                'name' => $user->name,
//                'email' => $user->email,
//            ]
//        );
    }
}





















