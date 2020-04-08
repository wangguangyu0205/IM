<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 好友关系
 * Class FriendRelation
 *
 * @since 2.0
 *
 * @Entity(table="friend_relation")
 */
class FriendRelation extends Model
{

    const STATUS_TEXT = [
        'offline',
        'online'
    ];

    /**
     * 主键
     * @Id()
     * @Column(name="friend_relation_id", prop="friendRelationId")
     *
     * @var int
     */
    private $friendRelationId;

    /**
     * 用户id
     *
     * @Column(name="user_id", prop="userId")
     *
     * @var int
     */
    private $userId;

    /**
     * 好友id
     *
     * @Column(name="friend_id", prop="friendId")
     *
     * @var int
     */
    private $friendId;

    /**
     * 好友所属分组id
     *
     * @Column(name="friend_group_id", prop="friendGroupId")
     *
     * @var int
     */
    private $friendGroupId;

    /**
     *
     *
     * @Column(name="created_at", prop="createdAt")
     *
     * @var string|null
     */
    private $createdAt;

    /**
     *
     *
     * @Column(name="updated_at", prop="updatedAt")
     *
     * @var string|null
     */
    private $updatedAt;

    /**
     * 删除时间 为NULL未删除
     *
     * @Column(name="deleted_at", prop="deletedAt")
     *
     * @var string|null
     */
    private $deletedAt;


    /**
     * @param int $friendRelationId
     *
     * @return self
     */
    public function setFriendRelationId(int $friendRelationId): self
    {
        $this->friendRelationId = $friendRelationId;

        return $this;
    }

    /**
     * @param int $userId
     *
     * @return self
     */
    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @param int $friendId
     *
     * @return self
     */
    public function setFriendId(int $friendId): self
    {
        $this->friendId = $friendId;

        return $this;
    }

    /**
     * @param int $friendGroupId
     *
     * @return self
     */
    public function setFriendGroupId(int $friendGroupId): self
    {
        $this->friendGroupId = $friendGroupId;

        return $this;
    }

    /**
     * @param string|null $createdAt
     *
     * @return self
     */
    public function setCreatedAt(?string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @param string|null $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(?string $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @param string|null $deletedAt
     *
     * @return self
     */
    public function setDeletedAt(?string $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @return int
     */
    public function getFriendRelationId(): ?int
    {
        return $this->friendRelationId;
    }

    /**
     * @return int
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getFriendId(): ?int
    {
        return $this->friendId;
    }

    /**
     * @return int
     */
    public function getFriendGroupId(): ?int
    {
        return $this->friendGroupId;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * @return string|null
     */
    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }

}
