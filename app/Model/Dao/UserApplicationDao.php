<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Model\Dao;

use App\Model\Entity\UserApplication;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class UserApplicationDao
 * @package App\Model\Dao
 * @Bean()
 */
class UserApplicationDao
{

    /**
     * @Inject()
     * @var UserApplication
     */
    protected $userApplicationEntity;

    public function createUserApplication($data)
    {
        return $this->userApplicationEntity::insertGetId($data);
    }
}
