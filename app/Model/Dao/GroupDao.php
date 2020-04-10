<?php

namespace App\Model\Dao;

use App\Model\Entity\Group;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Eloquent\Builder;

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


    public function create(array $data)
    {
        return $this->groupEntity::insertGetId($data);
    }

    public function getGroupByUserId(int $userId){
        return $this->groupEntity::whereNull('deleted_at')
            ->where('user_id','=',$userId)
            ->get();
    }

    public function getGroupByIds(array $ids){
        return $this->groupEntity::whereNull('deleted_at')
            ->whereIn('group_id',$ids)
            ->get();
    }

    public function getRecommendedGroup(int $limit){
        return $this->groupEntity::whereNull('deleted_at')
            ->orderBy('created_at','desc')
            ->limit($limit)
            ->get();
    }

    public function searchGroup(string $keyword, int $page, int $size){
        return $this->groupEntity::whereNull('deleted_at')
            ->where(function (Builder $builder) use ($keyword) {
                $builder->where('group_id','=',$keyword)
                    ->orWhere('group_name','like',"%$keyword%");
            })
            ->paginate($page,$size);
    }

}
