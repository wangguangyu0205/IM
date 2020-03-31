<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Http\Controller;


use App\Model\Logic\TestLogic;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\DB;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
/**
 * Class TestController
 * @package App\Http\Controller
 * @Controller(prefix="test")
 */
class TestController
{
    /**
     * @Inject()
     * @var TestLogic
     */
    private $testLogic;

    /**
     * @RequestMapping(route="getUserName",method={RequestMethod::GET})
     * @param Request $request
     * @return \Swoft\Http\Message\Response|\Swoft\Rpc\Server\Response|\Swoft\Task\Response
     */
    public function getUserName(Request $request)
    {
        apiValidate($request->get(),'TestValidator');
        $id = $request->get('id');
        $result = '';
        DB::transaction(function () use ($id,&$result) {
            $name = $this->testLogic->getUserName($id);
            $result = $name;
        });
        return apiSuccess($result);
    }
}
