<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://swoft.org/docs
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Http\Controller;

use App\ExceptionCode\ApiCode;
use App\Model\Logic\FriendLogic;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use App\Http\Middleware\AuthMiddleware;
use Swoft\Validator\Annotation\Mapping\Validate;

/**
 * Class FriendController
 *
 * @Controller(prefix="friend")
 * @package App\Http\Controller
 */
class FriendController
{
    /**
     * @Inject()
     * @var FriendLogic
     */
    protected $friendLogic;

    /**
     * @RequestMapping(route="createFriendGroup",method={RequestMethod::POST})
     * @Middleware(AuthMiddleware::class)
     * @Validate(validator="FriendValidator",fields={"friend_group_name"})
     */
    public function createFriendGroup(Request $request)
    {
        try {
            $friendGroupName = $request->post('friend_group_name');
            $friendGroupId = $this->friendLogic->createFriendGroup($request->user,$friendGroupName);
            if (!$friendGroupId) throw new \Exception('',ApiCode::FRIEND_GROUP_CREATE_ERROR);
            $result = $this->friendLogic->findFriendGroupById($friendGroupId);
            if (!$result) throw new \Exception('',ApiCode::FRIEND_GROUP_NOT_FOUND);
            return apiSuccess([
                'id' => $result->getFriendGroupId(),
                'groupname' => $result->getFriendGroupName()
            ]);
        } catch (\Throwable $throwable) {
            return apiError($throwable->getCode(), $throwable->getMessage());
        }
    }
}
