<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Model\Logic;

use App\ExceptionCode\ApiCode;
use App\Model\Dao\FriendGroupDao;
use App\Model\Dao\UserApplicationDao;
use App\Model\Dao\UserDao;
use App\Model\Dao\UserLoginLogDao;
use App\Model\Entity\User;
use App\Model\Entity\UserApplication;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class UserLogic
 * @package App\Model\Logic
 * @Bean()
 */
class UserLogic
{
    /**
     * @Inject()
     * @var UserDao
     */
    protected $userDao;

    /**
     * @Inject()
     * @var FriendGroupDao
     */
    protected $friendGroupDao;

    /**
     * @Inject()
     * @var UserLoginLogDao
     */
    protected $userLoginLogDao;

    /**
     * @Inject()
     * @var UserApplicationDao
     */
    protected $userApplicationDao;

    public function findUserInfoById(int $userId)
    {
        return $this->userDao->findUserInfoById($userId);
    }

    public function register(string $email, string $password)
    {
        $userInfo = $this->findUserInfoByEmail($email);
        if ($userInfo) {
            throw new \Exception('', ApiCode::USER_EMAIL_ALREADY_USE);
        }
        return $this->createUser(
            [
                'email' => $email,
                'username' => $email,
                'password' => password_hash($password, CRYPT_BLOWFISH),
                'sign' => '',
                'status' => User::STATUS_OFFLINE,
                'avatar' => 'https://s.gravatar.com/avatar/' . md5(strtolower(trim($email))),
            ]
        );

    }

    public function login(string $email, string $password)
    {
        $userInfo = $this->findUserInfoByEmail($email);
        if (!$userInfo || $userInfo['deleted_at'] != null) {
            throw new \Exception('', ApiCode::USER_NOT_FOUND);
        }
        if (!password_verify($password, $userInfo['password'])) {
            throw new \Exception('', ApiCode::USER_PASSWORD_ERROR);
        }

        return $userInfo->toArray();
    }

    public function createUserLoginLog(int $userId)
    {
        $request = context()->getRequest();
        $ip = empty($request->getHeaderLine('x-real-ip')) ? $request->getServerParams()['remote_addr'] : $request->getHeaderLine('x-real-ip');
        $data = [
            'user_id' => $userId,
            'user_login_ip' => $ip
        ];
        return $this->userLoginLogDao->createUserLoginLog($data);
    }

    public function findUserInfoByEmail(string $email)
    {
        return $this->userDao->findUserInfoByEmail($email);
    }

    public function createUser(array $data)
    {
        return $this->userDao->createUser($data);
    }

    public function getMine()
    {
        $userInfo = context()->getRequest()->userInfo;
        return [
            'username' => $userInfo->getUsername(),
            'id' => $userInfo->getUserId(),
            'status' => User::STATUS_TEXT[$userInfo->getStatus()],
            'sign' => $userInfo->getSign(),
            'avatar' => $userInfo->getAvatar(),
        ];
    }

    public function apply(int $userId, int $receiverId, int $groupId, string $applicationType, string $applicationReason)
    {
        if ($userId == $receiverId) throw new \Exception('', ApiCode::FRIEND_NOT_ADD_SELF);

        $friendInfo = $this->findUserInfoById($receiverId);
        if (!$friendInfo) throw new \Exception('', ApiCode::FRIEND_NOT_FOUND);

        $friendGroupInfo = $this->friendGroupDao->findFriendGroupById($groupId);
        if (!$friendGroupInfo) throw new \Exception('', ApiCode::FRIEND_GROUP_NOT_FOUND);

        $result = $this->createUserApplication($userId, $receiverId, $groupId, $applicationType, $applicationReason);
        if (!$result) throw new \Exception('', ApiCode::USER_CREATE_APPLICATION_FAIL);

        return $result;
    }

    public function createUserApplication(int $userId, int $receiverId, int $groupId, string $applicationType, string $applicationReason)
    {
        return $this->userApplicationDao->createUserApplication([
            'user_id' => $userId,
            'receiver_id' => $receiverId,
            'group_id' => $groupId,
            'application_type' => $applicationType,
            'application_status' => UserApplication::APPLICATION_STATUS_CREATE,
            'application_reason' => $applicationReason,
            'read_state' => UserApplication::UNREAD
        ]);
    }

    public function getUnreadApplicationCount(int $userId)
    {
        return $this->userApplicationDao->getUnreadApplicationCount($userId);
    }

    public function getApplication(int $userId, int $page, int $size)
    {
        $applications = $this->userApplicationDao->getApplication($userId, $page, $size);
        $result = [];
        /** @var UserApplication $application */
        foreach ($applications['list'] as $application) {

            $applicationRole = ($userId == $application['userId'])
                ? (($application['applicationStatus'] != UserApplication::APPLICATION_STATUS_CREATE)
                    ? $applicationRole = UserApplication::APPLICATION_SYSTEM
                    : UserApplication::APPLICATION_CREATE_USER)
                : UserApplication::APPLICATION_RECEIVER_USER;

            $result[] = [
                'user_id' => $application['userId'],
                'receiver_id' => $application['receiverId'],
                'application_role' => $applicationRole,
                'application_type' => $application['applicationType'],
                'created_at' => $application['createdAt'],
                'updated_at' => $application['updatedAt'],
                'application_status' => $application['applicationStatus'],
                'application_status_text' => UserApplication::APPLICATION_STATUS_TEXT[$application['applicationStatus']],
                'application_reason' => $application['applicationReason']
            ];
        }
        $applications['list'] = $result;
        return $applications;
    }

}
