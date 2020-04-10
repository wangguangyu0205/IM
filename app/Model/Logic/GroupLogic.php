<?php

namespace App\Model\Logic;

use App\ExceptionCode\ApiCode;
use App\Model\Dao\GroupDao;
use App\Model\Dao\GroupRelationDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class GroupLogic
 * @package App\Model\Logic
 * @Bean()
 */
class GroupLogic
{
    /**
     * @Inject()
     * @var GroupDao
     */
    protected $groupDao;

    /**
     * @Inject()
     * @var GroupRelationDao
     */
    protected $groupRelationDao;

    public function createGroup(int $userId, string $groupName, string $avatar, int $size, string $introduction, int $validation)
    {
        $groupId = $this->groupDao->create([
            'user_id' => $userId,
            'group_name' => $groupName,
            'avatar' => $avatar,
            'size' => $size,
            'introduction' => $introduction,
            'validation' => $validation
        ]);
        if (!$groupId) throw new \Exception('', ApiCode::GROUP_CREATE_FAIL);

        $groupRelationId = $this->createGroupRelation($userId, $groupId);
        if (!$groupRelationId) throw new \Exception('', ApiCode::GROUP_RELATION_CREATE_FAIL);

        $result = $this->findGroupById($groupId);
        if (!$result) throw new \Exception('', ApiCode::GROUP_NOT_FOUND);

        return $result;
    }

    public function findGroupById(int $groupId)
    {
        return $this->groupDao->findGroupById($groupId);
    }

    public function createGroupRelation(int $userId, int $groupId)
    {
        return $this->groupRelationDao->createGroupRelation([
            'user_id' => $userId,
            'group_id' => $groupId
        ]);
    }
}
