<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Http\Controller;


use App\Exception\ApiException;
use App\ExceptionCode\ApiCode;
use App\Helper\AuthHelper;
use App\Helper\JwtHelper;
use App\Model\Logic\TestLogic;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\DB;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Validator\Annotation\Mapping\Validate;
use App\Validator\TestValidator;
use Swoft\Validator\Annotation\Mapping\ValidateType;
use App\Http\Middleware\AuthMiddleware;
/**
 * Class TestController
 * @package App\Http\Controller
 * @Controller(prefix="test")
 */
class TestController
{
    use JwtHelper;
    use AuthHelper;
    /**
     * @Inject()
     * @var TestLogic
     */
    private $testLogic;

    /**
     * @RequestMapping(route="getUserName",method={RequestMethod::GET})
     * @Validate(validator="TestValidator",type=ValidateType::GET)
     * @param Request $request
     * @return \Swoft\Http\Message\Response|\Swoft\Rpc\Server\Response|\Swoft\Task\Response
     */
    public function getUserName(Request $request)
    {
        $id = $request->get('id');
        DB::beginTransaction();
        try {
            $result = $this->testLogic->getUserName($id);
            $this->testLogic->addUser();
            DB::commit();
            return apiSuccess($result);
        }catch (\Throwable $exception){
            DB::rollBack();
            return apiError($exception->getCode(),$exception->getMessage());
        }

    }

    /**
     * @RequestMapping(route="createToken",method={RequestMethod::GET})
     * @Middleware(AuthMiddleware::class)
     */
    public function createToken()
    {
        var_dump($this->userInfo());
        return apiSuccess(self::encrypt(1));
    }
}
