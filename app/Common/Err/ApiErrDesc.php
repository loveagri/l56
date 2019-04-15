<?php
/**
 * Created by PhpStorm.
 * User: fh
 * Date: 2019-04-15
 * Time: 21:02
 */

namespace App\Common\Err;


class ApiErrDesc
{
    const SUCCESS = [0, 'Success'];
    const UNKNOWN_ERR = [1, '未知错误'];
    const ERR_URL = [2, '访问的接口不存在'];

    const ERR_PARAMS = [100, '参数错误'];

    const ERR_PASSWORD = [1000, '密码错误'];
    const ERR_TOKEN = [1002, '登录过期'];
    const ERR_USER_NOT_EXIST = [1003, '用户名不存在'];
}
