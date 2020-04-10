<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Model\Dao;

use App\Model\Entity\FriendRelation;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class FriendRelationDao
 * @package App\Model\Dao
 * @Bean()
 */
class FriendRelationDao
{

    /**
     * @Inject()
     * @var FriendRelation
     */
    protected $friendRelationEntity;

    public function getFriendRelationByFriendGroupIds(array $friendGroupIds)
    {
        return $this->friendRelationEntity::whereNull('deleted_at')
            ->whereIn('friend_group_id', $friendGroupIds)
            ->get();
    }

    public function checkIsFriendRelation(int $userId, int $friendId)
    {
        return $this->friendRelationEntity::where('user_id', '=', $userId)
            ->where('friend_id', '=', $friendId)
            ->first();
    }
}
