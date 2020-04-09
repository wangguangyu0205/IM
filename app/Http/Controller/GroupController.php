<?php declare(strict_types=1);


namespace App\Http\Controller;

use App\Model\Logic\GroupLogic;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use App\Http\Middleware\AuthMiddleware;
use Swoft\Validator\Annotation\Mapping\Validate;
use Swoft\Http\Server\Annotation\Mapping\Controller;

/**
 * Class GroupController
 * @package App\Http\Controller
 * @Controller(prefix="group")
 */
class GroupController
{
    /**
     * @Inject()
     * @var GroupLogic
     */
    protected $groupLogic;

    /**
     * @RequestMapping(route="createGroup",method={RequestMethod::POST})
     * @Middleware(AuthMiddleware::class)
     * @Validate(validator="GroupValidator",fields={"user_id","group_name","avatar","size","introduction","validation"})
     */
    public function createGroup(Request $request)
    {
        try {
            $groupName = $request->parsedBody('group_name');
            $avatar = $request->parsedBody('avatar');
            $size = $request->parsedBody('size');
            $introduction = $request->parsedBody('introduction');
            $validation = $request->parsedBody('validation');

            $result = $this->groupLogic->createGroup($request->user,$groupName,$avatar,$size,$introduction,$validation);
            return apiSuccess($result);
        }catch (\Throwable $throwable){
            return apiError($throwable->getCode(),$throwable->getMessage());
        }
    }
}
