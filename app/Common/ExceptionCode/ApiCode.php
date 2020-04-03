<?php
/**
 * 定义api报错
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\ExceptionCode;


/**
 * Class ApiCode
 * @package App\ExceptionCode
 */
class ApiCode
{
    //基本错误码 0～1000
    const AUTH_ERROR = 401;

    //用户错误码 3000～3999

    const
        USER_NOT_FOUND = 3001,
        USER_ID_INVALID = 3002;

    // ext 9000~9999
    const
        JWT_PRIVATE_KEY_EMPTY = 9001,
        JWT_PUBLIC_KEY_EMPTY = 9002,
        JWT_ALG_EMPTY = 9003;

    public static $errorMessages = [


        self::AUTH_ERROR => 'Authorization has been denied for this request!',


        self::USER_NOT_FOUND => 'User not found!',
        self::USER_ID_INVALID => 'The user id is invalid!',

        self::JWT_PRIVATE_KEY_EMPTY => 'The private key is invalid!',
        self::JWT_PUBLIC_KEY_EMPTY => 'The public key is invalid!',
        self::JWT_ALG_EMPTY => 'The alg is invalid!',

    ];
}
