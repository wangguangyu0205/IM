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

use App\Model\Logic\UserLogic;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Validator\Annotation\Mapping\Validate;
use Swoft\View\Annotation\Mapping\View;

/**
 * Class UserController
 *
 * @Controller(prefix="user")
 * @package App\Http\Controller
 */
class UserController
{

    /**
     * @Inject()
     * @var UserLogic
     */
    protected $userLogic;


    /**
     * @RequestMapping(route="login",method={RequestMethod::POST})
     * @Validate(validator="UserValidator",fields={"email","password"})
     */
    public function login(Request $request)
    {
        try {
            $email = $request->post('email');
            $password = $request->post('password');
            $userInfo = $this->userLogic->login($email, $password);
            return apiSuccess($userInfo);
        } catch (\Throwable $throwable) {
            return apiError($throwable->getCode(), $throwable->getMessage());
        }
    }

    /**
     * @RequestMapping(route="register",method={RequestMethod::POST})
     * @Validate(validator="UserValidator",fields={"email","password"})
     */
    public function register(Request $request)
    {
        try {
            $email = $request->post('email');
            $password = $request->post('password');
            $this->userLogic->register($email, $password);
            return apiSuccess();
        } catch (\Throwable $throwable) {
            return apiError($throwable->getCode(), $throwable->getMessage());
        }
    }

    /**
     * @RequestMapping(route="home",method={RequestMethod::GET})
     * @View(template="user/home")
     */
    public function home()
    {
        return [];
    }

    /**
     * @RequestMapping(route="msgBox",method={RequestMethod::GET})
     * @View(template="user/msgbox")
     */
    public function msgBox()
    {
        return [];
    }

    /**
     * @RequestMapping(route="findUser",method={RequestMethod::GET})
     * @View(template="user/finduser")
     */
    public function findUser()
    {
        return [];
    }

    /**
     * @RequestMapping(route="chatLog",method={RequestMethod::GET})
     * @View(template="user/chatlog")
     */
    public function chatLog()
    {
        return [];
    }
}
