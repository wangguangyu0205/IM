<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Model\Logic;

use App\Model\Dao\UserDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class UserLogic
 * @package App\Model\Logic
 * @Bean()
 */
class UserLogic
{
    /**
     * @Inject()
     * @var UserDao
     */
    protected $userDao;

    public function findUserInfo(int $userId)
    {
        return $this->userDao->findUserInfo($userId);
    }

}
