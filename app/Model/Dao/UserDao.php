<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Model\Dao;

use App\Model\Entity\User;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class UserDao
 * @package App\Model\Dao
 * @Bean()
 */
class UserDao
{
    /**
     * @Inject()
     * @var User
     */
    protected $userEntity;

    public function findUserInfo(int $userId){
        return $this->userEntity::whereNull('deleted_at')->find($userId);
    }
}
