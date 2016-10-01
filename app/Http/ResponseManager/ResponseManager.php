<?php
/**
 * Created by PhpStorm.
 * User: milver
 * Date: 25-09-16
 * Time: 07:32 PM
 */

namespace App\Http\ResponseManager;


class ResponseManager
{
    /**
     * Generates result response object
     *
     * @param mixed  $data
     * @param string $message
     *
     * @return array
     */
    public static function makeResult($data, $message)
    {
        $result = array();
        $result['flag'] = true;
        $result['message'] = $message;
        $result['data'] = $data;

        return $result;
    }

    /**
     * Generates error response object
     *
     * @param int    $errorCode
     * @param string $message
     * @param mixed  $data
     *
     * @return array
     */
    public static function makeError($errorCode, $message, $data = array())
    {
        $error = array();
        $error['flag'] = false;
        $error['message'] = $message;
        $error['code'] = $errorCode;
        if(!empty($data))
            $error['data'] = $data;

        return $error;
    }
}