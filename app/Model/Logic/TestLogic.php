<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Model\Logic;

use App\Model\Dao\TestDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class TestLogic
 * @package App\Model\Logic
 * @Bean()
 */
class TestLogic
{
    /**
     * @Inject()
     * @var TestDao
     */
    private $testDao;

    public function getUserName($id){
        $info = $this->testDao->getUserInfo($id);
        return $info['name'] ?? '';
    }

    public function addUser(){
        return $this->testDao->addUser();
    }
}
