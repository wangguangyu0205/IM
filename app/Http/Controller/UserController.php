<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Http\Controller;


use App\Exception\ApiException;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\View\Annotation\Mapping\View;

/**
 * Class UserController
 * @package App\Http\Controller
 * @Controller(prefix="user")
 */
class UserController
{
    /**
     * @RequestMapping(route="login",method={RequestMethod::POST})
     */
    public function login()
    {
        return [];
    }

    /**
     * @RequestMapping(route="register",method={RequestMethod::POST})
     */
    public function register(){

    }

    /**
     * @RequestMapping(route="home",method={RequestMethod::GET})
     * @View(template="user/home")
     */
    public function home(){
        return [];
    }

    /**
     * @RequestMapping(route="msgBox",method={RequestMethod::GET})
     * @View(template="user/msgbox")
     */
    public function msgBox(){
        return [];
    }

    /**
     * @RequestMapping(route="findUser",method={RequestMethod::GET})
     * @View(template="user/finduser")
     */
    public function findUser(){
        return [];
    }

    /**
     * @RequestMapping(route="chatLog",method={RequestMethod::GET})
     * @View(template="user/chatlog")
     */
    public function chatLog(){
        return [];
    }
}
