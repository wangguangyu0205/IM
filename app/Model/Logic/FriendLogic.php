<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Model\Logic;

use App\Model\Dao\FriendGroupDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class FriendLogic
 * @package App\Model\Logic
 * @Bean()
 */
class FriendLogic
{
    /**
     * @Inject()
     * @var FriendGroupDao
     */
    protected $friendGroupDao;

    public function createFriendGroup(int $userId, string $friendGroupName):int
    {
        return $this->friendGroupDao->create(
            [
                'user_id' => $userId,
                'friend_group_name' => $friendGroupName
            ]
        );
    }

    public function findFriendGroupById(int $friendGroupId)
    {
        return $this->friendGroupDao->findFriendGroupById($friendGroupId);
    }
}
