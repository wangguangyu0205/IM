<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Model\Logic;


use App\Model\Dao\UserLoginLogDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class UserLoginLogLogic
 * @package App\Model\Logic
 * @Bean()
 */
class UserLoginLogLogic
{
    /**
     * @Inject()
     * @var UserLoginLogDao
     */
    protected $userLoginLogDao;

    public function insertUserLoginLog(int $userId)
    {
        $request = context()->getRequest();
        $ip = empty($request->getHeaderLine('x-real-ip')) ? $request->getServerParams()['remote_addr'] : $request->getHeaderLine('x-real-ip');
        $data = [
            'user_id' => $userId,
            'user_login_ip' => $ip
        ];
        return $this->userLoginLogDao->insertUserLoginLog($data);
    }
}
