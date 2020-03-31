<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */
namespace App\Exception;

use Throwable;

/**
 * Class ApiException
 *
 * @since 2.0
 */
class ApiException extends \Exception
{
    public function __construct($message = "", $code = -1, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
