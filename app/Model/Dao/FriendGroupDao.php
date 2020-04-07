<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Model\Dao;

use App\Model\Entity\FriendGroup;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class FriendGroupDao
 * @package App\Model\Dao
 * @Bean()
 */
class FriendGroupDao
{
    /**
     * @Inject()
     * @var FriendGroup
     */
    protected $friendGroupEntity;

    public function create(array $data){
        return $this->friendGroupEntity::insertGetId($data);
    }

    public function findFriendGroupById(int $friendGroupId){
        return $this->friendGroupEntity::find($friendGroupId);
    }
}
