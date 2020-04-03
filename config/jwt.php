<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */

return [
    'private_key' => 'im20200331',
    'public_key' => 'im20200331',
    'iss' => env('APP_HOST'),
    'aud' => env('APP_HOST'),
    'alg' => 'HS256' // 为RS256 需要修改私钥和公钥
];
