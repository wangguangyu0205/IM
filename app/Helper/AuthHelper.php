<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Helper;


use App\Exception\ApiException;
use App\ExceptionCode\ApiCode;
use App\Model\Entity\User;

trait AuthHelper
{
    public static function userInfo()
    {
        if (!is_int($userId = context()->getRequest()->user)) {
            throw new ApiException('',ApiCode::USER_ID_INVALID);
        }

        /**
         * @var User $userInfo
         */
        $userInfo = bean('App\Model\Logic\UserLogic')->findUserInfoById($userId);

        if (!$userInfo) {
            throw new ApiException('',ApiCode::USER_NOT_FOUND);
        }

        return $userInfo;
    }
}
