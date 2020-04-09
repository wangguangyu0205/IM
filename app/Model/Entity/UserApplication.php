<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 用户申请表
 * Class UserApplication
 *
 * @since 2.0
 *
 * @Entity(table="user_application")
 */
class UserApplication extends Model
{
    const UNREAD = 0;
    const APPLICATION_STATUS_CREATE = 0;

    const APPLICATION_STATUS_TEXT = [
        '等待验证',
        '已同意',
        '已拒绝'
    ];

    const APPLICATION_CREATE_USER  = 'create';
    const APPLICATION_RECEIVER_USER  = 'receiver';
    const APPLICATION_SYSTEM = 'system';

    /**
     * 主键
     * @Id()
     * @Column(name="user_application_id", prop="userApplicationId")
     *
     * @var int
     */
    private $userApplicationId;

    /**
     * 申请方
     *
     * @Column(name="user_id", prop="userId")
     *
     * @var int
     */
    private $userId;

    /**
     * 接收方
     *
     * @Column(name="receiver_id", prop="receiverId")
     *
     * @var int
     */
    private $receiverId;

    /**
     * 好友分组id || 群id
     *
     * @Column(name="group_id", prop="groupId")
     *
     * @var int
     */
    private $groupId;

    /**
     * 申请类型 好友 ｜ 群
     *
     * @Column(name="application_type", prop="applicationType")
     *
     * @var string
     */
    private $applicationType;

    /**
     * 申请状态 0创建 1同意 2拒绝
     *
     * @Column(name="application_status", prop="applicationStatus")
     *
     * @var int
     */
    private $applicationStatus;

    /**
     * 申请原因
     *
     * @Column(name="application_reason", prop="applicationReason")
     *
     * @var string
     */
    private $applicationReason;

    /**
     * 读取状态 0 未读 1 已读
     *
     * @Column(name="read_state", prop="readState")
     *
     * @var int
     */
    private $readState;

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
     * @param int $userApplicationId
     *
     * @return self
     */
    public function setUserApplicationId(int $userApplicationId): self
    {
        $this->userApplicationId = $userApplicationId;

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
     * @param int $receiverId
     *
     * @return self
     */
    public function setReceiverId(int $receiverId): self
    {
        $this->receiverId = $receiverId;

        return $this;
    }

    /**
     * @param int $groupId
     *
     * @return self
     */
    public function setGroupId(int $groupId): self
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * @param string $applicationType
     *
     * @return self
     */
    public function setApplicationType(string $applicationType): self
    {
        $this->applicationType = $applicationType;

        return $this;
    }

    /**
     * @param int $applicationStatus
     *
     * @return self
     */
    public function setApplicationStatus(int $applicationStatus): self
    {
        $this->applicationStatus = $applicationStatus;

        return $this;
    }

    /**
     * @param string $applicationReason
     *
     * @return self
     */
    public function setApplicationReason(string $applicationReason): self
    {
        $this->applicationReason = $applicationReason;

        return $this;
    }

    /**
     * @param int $readState
     *
     * @return self
     */
    public function setReadState(int $readState): self
    {
        $this->readState = $readState;

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
    public function getUserApplicationId(): ?int
    {
        return $this->userApplicationId;
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
    public function getReceiverId(): ?int
    {
        return $this->receiverId;
    }

    /**
     * @return int
     */
    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    /**
     * @return string
     */
    public function getApplicationType(): ?string
    {
        return $this->applicationType;
    }

    /**
     * @return int
     */
    public function getApplicationStatus(): ?int
    {
        return $this->applicationStatus;
    }

    /**
     * @return string
     */
    public function getApplicationReason(): ?string
    {
        return $this->applicationReason;
    }

    /**
     * @return int
     */
    public function getReadState(): ?int
    {
        return $this->readState;
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
