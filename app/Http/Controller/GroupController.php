<?php declare(strict_types=1);


namespace App\Http\Controller;

use App\Model\Logic\GroupLogic;
use Swoft\Bean\Annotation\Mapping\Inject;
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
}
