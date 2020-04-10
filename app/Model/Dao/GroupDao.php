<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Model\Dao;

use App\Model\Entity\Group;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class GroupDao
 * @package App\Model\Dao
 * @Bean()
 */
class GroupDao
{
    /**
     * @Inject()
     * @var Group
     */
    protected $groupEntity;

    public function findGroupById(int $groupId)
    {
        return $this->groupEntity::whereNull('deleted_at')->find($groupId);
    }

}
