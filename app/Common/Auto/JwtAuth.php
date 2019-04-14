<?php
/**
 * Created by PhpStorm.
 * User: fh
 * Date: 2019-04-14
 * Time: 21:52
 */

namespace App\Common\Auto;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;

/**
 * 单例
 * Class JwtAuth
 * @package App\Common\Auto
 */
class JwtAuth
{
    private $token;
    private $iss = 'l56.laravel.com';
    private $aud = 'imooc_server_app';
    private $uid;
    private $secret = 'd4aslkhrq3lo9ur7fds9rfahfa';
    private $decodeToken;
    private static $instance;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public function getToken()
    {
        return (string)$this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * @return $this
     */
    public function encode()
    {
        $time = time();
        $this->token = (new Builder())
            ->setHeader('alg', 'HS256')
            ->setIssuer($this->iss)
            ->setAudience($this->aud)
            ->setIssuedAt($time)
            ->setExpiration($time + 3600)
            ->set('uid', $this->uid)
            ->sign(new Sha256(), $this->secret)
            ->getToken();

        return $this;
    }

    public function decode()
    {
        if (!$this->decodeToken){
            $this->decodeToken = (new Parser())->parse((string)$this->token);
            $this->uid = $this->decodeToken->getClaim('uid');
        }

        return $this->decodeToken;
    }

    public function validate()
    {
        $data = new ValidationData();

        $data->setIssuer($this->iss);
        $data->setAudience($this->aud);

        return $this->decode()->validate($data);
    }

    public function verify()
    {
        $result = $this->decode()->verify(new Sha256(), $this->secret);
        return $result;
    }
}



















