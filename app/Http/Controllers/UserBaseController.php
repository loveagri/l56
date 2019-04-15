<?php

namespace App\Http\Controllers;

use App\Common\Auto\JwtAuth;
use App\Http\Response\ResponseJson;
use Illuminate\Routing\Controller as BaseController;

class UserBaseController extends BaseController
{
    use ResponseJson;
    public $uid;

    public function __construct()
    {
        $jwtAuth = JwtAuth::getInstance();
        $this->uid = $jwtAuth->getUid();

    }
}
