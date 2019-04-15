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
        print_r(request()->input('token'));
        print_r(JwtAuth::getInstance());exit;
        $this->uid = JwtAuth::getInstance()->getUid();

    }
}
