<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Model\Dao;


use App\Model\Entity\UserLoginLog;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class UserLoginLogDao
 * @package App\Model\Dao
 * @Bean()
 */
class UserLoginLogDao
{
    /**
     * @Inject()
     * @var UserLoginLog
     */
    protected $userLoginLogEntity;

    public function createUserLoginLog(array $data)
    {
        return $this->userLoginLogEntity::insert($data);
    }
}
