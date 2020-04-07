<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Http\Controller;


use Swoft\Http\Message\Request;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use function view;

/**
 * Class StaticController
 * @package App\Http\Controller
 * @Controller(prefix="static")
 */
class StaticController
{
    /**
     * @RequestMapping(route="login",method={RequestMethod::GET})
     */
    public function login()
    {
        return view('user/login');
    }

    /**
     * @RequestMapping(route="register",method={RequestMethod::GET})
     */
    public function register()
    {
        return view('user/register');
    }

    /**
     * @RequestMapping(route="createFriendGroup",method={RequestMethod::GET})
     */
    public function createFriendGroup(Request $request, Response $response)
    {
        if (!$userId = checkAuth()) return $response->redirect('/static/login');
        return view('friend/createGroup');
    }
}
