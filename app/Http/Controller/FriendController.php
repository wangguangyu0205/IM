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
use App\Model\Logic\UserLogic;
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
     * @Inject()
     * @var UserLogic
     */
    protected $userLogic;

    /**
     * @RequestMapping(route="createFriendGroup",method={RequestMethod::POST})
     * @Middleware(AuthMiddleware::class)
     * @Validate(validator="FriendValidator",fields={"friend_group_name"})
     */
    public function createFriendGroup(Request $request)
    {
        try {
            $friendGroupName = $request->post('friend_group_name');

            $friendGroupId = $this->friendLogic->createFriendGroup($request->user, $friendGroupName);
            if (!$friendGroupId) throw new \Exception('', ApiCode::FRIEND_GROUP_CREATE_FAIL);

            $result = $this->friendLogic->findFriendGroupById($friendGroupId);
            if (!$result) throw new \Exception('', ApiCode::FRIEND_GROUP_NOT_FOUND);

            return apiSuccess([
                'id' => $result->getFriendGroupId(),
                'groupname' => $result->getFriendGroupName()
            ]);
        } catch (\Throwable $throwable) {
            return apiError($throwable->getCode(), $throwable->getMessage());
        }
    }

    /**
     * @RequestMapping(route="getRecommendedFriend",method={RequestMethod::GET})
     * @Middleware(AuthMiddleware::class)
     */
    public function getRecommendedFriend()
    {
        try {
            $friends = $this->friendLogic->getRecommendedFriend(20);
            return apiSuccess($friends);
        } catch (\Throwable $throwable) {
            return apiError($throwable->getCode(), $throwable->getMessage());
        }
    }

    /**
     * @RequestMapping(route="search",method={RequestMethod::POST})
     * @Middleware(AuthMiddleware::class)
     * @Validate(validator="SearchValidator",fields={"keyword","page","size"})
     */
    public function searchFriend(Request $request)
    {
        try {
            $keyword = $request->parsedBody('keyword');
            $page = $request->parsedBody('page');
            $size = $request->parsedBody('size');
            $friends = $this->friendLogic->searchFriend($keyword,$page,$size);
            return apiSuccess($friends);
        } catch (\Throwable $throwable) {
            return apiError($throwable->getCode(), $throwable->getMessage());
        }
    }

    /**
     * @RequestMapping(route="apply",method={RequestMethod::POST})
     * @Middleware(AuthMiddleware::class)
     * @Validate(validator="FriendValidator",fields={"receiver_id","group_id","application_type","application_reason"})
     */
    public function apply(Request $request){
        try {
            $userId = $request->user;
            $receiverId = $request->parsedBody('receiver_id');
            $groupId= $request->parsedBody('group_id');
            $applicationType= $request->parsedBody('application_type');
            $applicationReason= $request->parsedBody('application_reason');

            if ($userId == $receiverId) throw new \Exception('',ApiCode::FRIEND_NOT_ADD_SELF);

            $friendInfo = $this->userLogic->findUserInfoById($receiverId);
            if (!$friendInfo) throw new \Exception('',ApiCode::FRIEND_NOT_FOUND);

            $friendGroupInfo = $this->friendLogic->findFriendGroupById($groupId);
            if (!$friendGroupInfo) throw new \Exception('', ApiCode::FRIEND_GROUP_NOT_FOUND);

            $result = $this->userLogic->createUserApplication($userId,$receiverId,$groupId,$applicationType,$applicationReason);
            if (!$result) throw new \Exception('',ApiCode::USER_CREATE_APPLICATION_FAIL);

            return apiSuccess();
        }catch (\Throwable $throwable){
            return apiError($throwable->getCode(), $throwable->getMessage());
        }
    }
}
