<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Model\Logic;

use App\ExceptionCode\ApiCode;
use App\Model\Dao\UserDao;
use App\Model\Dao\UserLoginLogDao;
use App\Model\Entity\User;
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
     * @var UserLoginLogDao
     */
    protected $userLoginLogDao;

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
                'avatar' => User::DEFAULT_AVATAR,
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

}
