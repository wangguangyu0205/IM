<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Exception\Handler;

use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Exception\Handler\AbstractHttpErrorHandler;
use Swoft\Log\Helper\CLog;
use Swoft\Log\Helper\Log;
use Throwable;
use function get_class;
use function sprintf;
use const APP_DEBUG;

/**
 * Class HttpExceptionHandler
 *
 * @ExceptionHandler(\Throwable::class)
 */
class HttpExceptionHandler extends AbstractHttpErrorHandler
{
    /**
     * @param Throwable $except
     * @param Response  $response
     *
     * @return Response
     */
    public function handle(Throwable $except, Response $response): Response
    {
        // Log error message
        Log::error($except->getMessage());
        CLog::error('%s. (At %s line %d)', $except->getMessage(), $except->getFile(), $except->getLine());

        // 这里code默认为-1 因为layIm的api成功返回的code为0
        $code = ($except->getCode() == 0) ? -1 : $except->getCode();
        $message = $except->getMessage();



        // Debug is true
        if (APP_DEBUG) {
            $message = sprintf('(%s) %s', get_class($except), $except->getMessage());
        }
        return throwApiException(
            $code,
            $message,
            sprintf('At %s line %d', $except->getFile(), $except->getLine()),
            $except->getTraceAsString()
        );
    }
}
