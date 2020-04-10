<?php

namespace App\Model\Dao;

use App\Model\Entity\GroupRelation;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class GroupRelationDao
 * @package App\Model\Dao
 * @Bean()
 */
class GroupRelationDao
{
    /**
     * @Inject()
     * @var GroupRelation
     */
    protected $groupRelationEntity;

    public function createGroupRelation(array $data){
        return $this->groupRelationEntity::insertGetId($data);
    }
}
