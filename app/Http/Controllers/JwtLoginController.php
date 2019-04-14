<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\Auto\JwtAuth;
use App\Http\Response\ResponseJson;
use Illuminate\Routing\Controller as BaseController;

class JwtLoginController extends BaseController
{

    use ResponseJson;

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');


        $jwtAuth = JwtAuth::getInstance();
        $token = $jwtAuth->setUid(1)->encode()->getToken();


        return $this->jsonSuccessData(
            [
                'token' => $token,
            ]
        );
    }
}
