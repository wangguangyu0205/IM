<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Http\Controller;


use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\View\Annotation\Mapping\View;

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
     * @View(template="user/register")
     */
    public function register() : array
    {
        return [];
    }
}
