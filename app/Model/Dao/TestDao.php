<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Model\Dao;


use App\Model\Entity\Test;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class TestDao
 * @package App\Model\Dao
 * @Bean()
 */
class TestDao
{
    /**
     * @Inject()
     * @var Test
     */
    private $testEntity;


    public function getUserInfo($id){
        return $this->testEntity->find($id);
    }
}
