<?php
/**
 * Created by PhpStorm.
 * User: fh
 * Date: 2019-04-14
 * Time: 22:21
 */


namespace App\Http\Response;

trait ResponseJson
{
    public function jsonData($code, $message, $data = [])
    {
        return $this->jsonResponse($code, $message, $data);
    }

    public function jsonSuccessData($data = [])
    {
        return $this->jsonResponse(0, 'Success', $data);
    }

    private function jsonResponse($code, $message, $data)
    {
        $content = [
            'code' => $code,
            'msg' => $message,
            'data' => $data,
        ];

        return response()->json($content);
    }
}
