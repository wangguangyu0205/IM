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

    public function findUserInfoById(int $userId){
        return $this->userEntity::whereNull('deleted_at')->find($userId);
    }

    public function findUserInfoByEmail(string $email){
        return $this->userEntity::where('email','=',$email)->first();
    }

    public function insertUser(array $data){
        return $this->userEntity::insert($data);
    }
}
