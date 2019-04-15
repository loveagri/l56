<?php
/**
 * Created by PhpStorm.
 * User: fh
 * Date: 2019-04-15
 * Time: 21:18
 */

namespace App\Exceptions;


use Throwable;

class ApiException extends \RuntimeException
{
    public function __construct(array $apiException,Throwable $previous = null)
    {
        $code = $apiException[0];
        $message = $apiException[1];
        parent::__construct($message, $code, $previous);
    }
}
