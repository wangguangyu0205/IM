<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Helper;


use App\Exception\ApiException;
use App\ExceptionCode\ApiCode;
use Firebase\JWT\JWT;

/**
 * Trait JwtHelper
 * @package App\Helper
 */
trait JwtHelper
{
    /**
     * @param int $userId
     * @return string
     * @throws ApiException
     */
    public static function encrypt(int $userId)
    {

        list($privateKey, $publicKey, $alg) = self::checkJwtParams();

        $payload = [
            'iss' => config('jwt.iss'),
            'aud' => config('jwt.aud'),
            'iat' => time(),
            'user' => $userId
        ];

        return JWT::encode($payload, $privateKey, $alg);
    }

    /**
     * @param string $jwt
     * @return int
     * @throws ApiException
     */
    public static function decrypt(string $jwt)
    {

        list($privateKey, $publicKey, $alg) = self::checkJwtParams();

        $payload = JWT::decode($jwt, $publicKey, [$alg]);

        return $payload->user ?? 0;
    }

    /**
     * @return array
     * @throws ApiException
     */
    private static function checkJwtParams()
    {
        $privateKey = config('jwt.private_key', '');

        if (empty($privateKey)) {
            throw new ApiException('', ApiCode::JWT_PRIVATE_KEY_EMPTY);
        }

        $publicKey = config('jwt.public_key', '');

        if (empty($publicKey)) {
            throw new ApiException('', ApiCode::JWT_PUBLIC_KEY_EMPTY);
        }

        $alg = config('jwt.alg');
        if (empty($alg)) {
            throw new ApiException('', ApiCode::JWT_ALG_EMPTY);
        }

        return [$privateKey, $publicKey, $alg];
    }
}
